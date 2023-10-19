<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Invitation;
use App\Events\UserInvited;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     */
    public function index()
    {
        return Inertia::render('User', [
            'users' => User::all(),
            'invitations_sent' => Invitation::all()->transform(function ($invitation) {
                return [
                    'email' => $invitation->email,
                    'status' => $invitation->status,
                    'created_at' => date_format($invitation->created_at, 'Y/m/d à H:i:s')
                ];
            })
        ]);
    }

    /**
     * Send user invitation to a guest
     */
    public function sendInvitation(Request $request) 
    {

        $data = [
            'email' => $request->email,
            'status' => 'PENDING',
            'token' => Str::random(40),
            'token_expires_at' => now()->addDays(3),
            'sent_by' => $request->user()->id
        ];
        
        $invitation = Invitation::create($data);

        // Déclenchement d'un évènement Utilisateur invité et envoi du mail
        event(new UserInvited($invitation->email, $invitation->token, $invitation->id));

    }

    /**
     * Verify invited user 
     */
    public function verifyInvitedUser(int $invitationId, String $token) {

        
            try {
                
                $invitation = Invitation::find($invitationId)->where('token','=',$token)->get()[0];
      
                // If invitation exists and token doesn't expire, we log in the guest as user
                if(!empty($invitation) && $invitation->token_expires_at > now()) {
                 
                    return Inertia::render('Auth/UserInvitedLogin', [
                        'invitation' => $invitation->id
                    ]);
                    
                }

            } catch (\Exception $e) {
                
                return to_route('unauthorized');

            }
       

    }
        

    /**
     * Authenticate invited user
     */

    public function authenticateInvitedUser(Request $request) {

        // Validation des données
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'userName' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', Password::min(8)]
        ]);

        // Changement du statut de l'invitation à "ACCEPTED"
        $invitation = Invitation::find($request->invitation);
        $invitation->update(['status' => 'ACCEPTED']);

        // Enregistrement de l'utilisateur dans la BDD
        $user = User::create([
            'name' => $validated['userName'],
            'email' => $invitation->email,
            'password' => Hash::make($validated['password'])
        ]);

        // On connecte l'utilisateur
        Auth::login($user);

        // On redirige l'utilisateur sur l'accueil
        return redirect(RouteServiceProvider::HOME);


    }


    /**
     * Show unauthorized user page 
     */

    public function showUnauthorizedPage() {

        return Inertia::render('Auth/Unauthorized');

    }

    /**
     * Delete invitation
     */

     public function deleteInvitation(Invitation $invitation) {

        $invitation->delete();

     }


    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
