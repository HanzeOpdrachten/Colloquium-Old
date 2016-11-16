<?php
/**
 * Profile Controller
 *
 * @author       Robert / Moubarak Hayal
 */

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\SoftwareLanguages;
use Illuminate\Http\Request;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function profile(){
        return view('profile/profile', array('user' => Auth::user()) );
    }

    public function update_avatar(Request $request){

        // Handle the user upload of avatar
        if($request->hasFile('image')){
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/avatars/' . $filename ) );

            $user = Auth::user();
            $user->image = $filename;
            $user->save();
        }

        return view('profile/profile', array('user' => Auth::user()) );

    }
    public function index() {
        return view('profile/profile');
    }
    private $_importantFields;
    /**
     * Directory to upload?
     * @var
     */
    private $_dir;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        // Do nothing
    }

    /**
     * Show the user's profile
     * @return view
     */


    /**
     * Allow the user to edit his/her account settings
     * @return view
     */
    public function settings() {
        $languages = SoftwareLanguages::all();
        return view('profile/settings')->with('languages', $languages);
    }

    /**
     * Save the user's settings
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(UpdateProfileRequest $request) {

        // If we have chosen a language, make sure it exists. If not, use English
        $language = SoftwareLanguages::get()->where('directory', $request['prefered_language']);
        if (count($language) == 0)
            $request['prefered_language'] = 'en';

        // Update the user's profile
        $user = Auth::user();
        $user->update($request->input());

        return redirect('/profile/settings');
    }

    /**
     * The avatar uploading page
     * @return view
     */
    public function avatar() {
        return view('profile/avatar');
    }

    /**
     * Upload an avatar
     * @param file $file The file that should be uploaded
     * @return boolean
     */
    //private function uploadAvatar($avatar) {
        /*
        // The image should have a certain extension
        if (!in_array($avatar->getClientOriginalExtension, $this->_imageExtensions))
            return 'wrong_extension';
        elseif ($avatar->getSize() > $this->_maxAvatarSize)
            return 'too_large';
        elseif ($avatar->getSize() < 125)
            return 'too_small';

        // Move the avatar
        $originalFileName = getClientOriginalName();
        $moveFile = $avatar->move($_avatarPath, $originalFileName);
        if (!$moveFile)
            return 'upload_failed';

        return true;*/
    } 
}