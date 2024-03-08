<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flash;
use DB;
use App\Models\Dapartemen;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('permission:user.index', ['only' => ['index','show']]);
        $this->middleware('permission:user.create', ['only' => ['create','store']]);
        $this->middleware('permission:user.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user.destroy', ['only' => ['destroy']]);
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->paginate(10);

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        $roles = [];
        $isEditPage = false;
        $sRoles = Role::orderBy('name')->get();
        $dapartemens = Dapartemen::orderBy('name')->get();

        return view('users.create',compact('roles','sRoles','isEditPage','dapartemens'));
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $roles = [];
        $input = $request->all();
        unset($input['email_verified_at']);

        if ($request->has('s_role_id')) {
            // Ambil nama peran berdasarkan ID yang diberikan
            $roles = Role::whereIn('id', $input['s_role_id'])->pluck('name')->toArray();
        }

        if ($request->has('s_dapartemen_id')) {
            // Ambil ID departemen yang dipilih oleh pengguna
            $dapartemens = $input['s_dapartemen_id'];
        }

        DB::transaction(function () use ($input, $roles, $dapartemens) {
            $user = $this->userRepository->create($input);
            $user->syncRoles($roles);
            // Sisipkan relasi banyak-ke-banyak ke departemen
            $user->dapartemens()->attach($dapartemens);
            $user->password = bcrypt($input['password']);
            $user->save();
        }, 3);

        Flash::success('User saved successfully.');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $sRoles = Role::orderBy('name')->get();
        $roles = $user->roles->pluck('id')->toArray();

        // Mendapatkan semua dapartemen untuk ditampilkan pada formulir
        $dapartemens = Dapartemen::orderBy('name')->get();
        $userDapartemens = $user->dapartemens->pluck('id')->toArray();

        $isEditPage = true;

        return view('users.edit', compact('roles', 'sRoles', 'isEditPage', 'dapartemens', 'userDapartemens','user'));
    }


    public function update($id, Request $request)
    {
        $role = Auth::user()->getRoleNames()->first();
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $input=$request->all();

        if($input['password'] === '' || $input['password'] === null){
            unset($input['password']);
        }

        $roles=[];
        if ($request->has('s_role_id')) {
            $roles = Role::whereIn('id', $input['s_role_id'])->pluck('name')->toArray();
        }

        // Mengambil dapartemen yang dipilih dari formulir
        $userDapartemens = isset($input['s_dapartemen_id']) ? $input['s_dapartemen_id'] : [];

        unset($input['remember_token']);
        unset($input['email_verified_at']);
        
        DB::transaction(function () use ($input, $roles, $userDapartemens, $id, $request) {
            $user = $this->userRepository->update($input, $id);
            $user->syncRoles($roles);

             // Menyimpan dapartemen yang dipilih
            $user->dapartemens()->sync($userDapartemens);

            if(isset($input['password'])){
                $user->password = bcrypt($input['password']);
            }
            $user->save();
        },3);

        Flash::success('User updated successfully');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        DB::transaction(function () use($user,$id){
            $user->syncRoles([]);
            $this->userRepository->delete($id);
        },3);

        Flash::success('User deleted successfully.');
        return redirect(route('users.index'));
    }

    public function profile() {
        $user = Auth::user();
        return view('users.profile.profile', compact('user'));
    }
    
    public function editProfile() {
        $user = Auth::user();
        return view('users.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        // Use the validate method to get a Validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
        ]);

        if ($validator->fails()) {
            // Use the errors() method to get the error messages
            $errors = $validator->errors();
    
            Flash::error('Profile updated failed: ' . $errors->first());
            return redirect()->route('edit.profile');
        }


        unset($request['password']);
        $user->update($request->all());

        Flash::success('Profile updated successfully.');
        return redirect()->route('profile');
    }

    function updatePassword(Request $request) {
        $user = Auth::user();
        // $user->update(['password' => bcrypt('12345678')]);
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required',
            'password_confirm' => 'required|same:password_baru'
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            Flash::error('Password updated failed: ' . $errors->first());
            return redirect()->route('edit.profile');
        }

        if (!Hash::check($request->password_lama, $user->password)) {
            Flash::error('Password lama tidak sesuai.');
            return redirect()->route('edit.profile');
        }

        $user->update(['password' => bcrypt($request->password_baru)]);

        Flash::success('Password updated successfully.');
        return redirect()->route('profile');
    }

    function updateFotoProfile(Request $request) {
        $user = Auth::user();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $user->clearMediaCollection('foto');
            $user->addMedia($file)->toMediaCollection('foto');
        }

        Flash::success('Foto profile updated successfully.');
        return redirect()->route('profile');
    }
}
