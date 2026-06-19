<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Http\Requests\Frontend\Speaking\storeRequest;
use App\Http\Requests\Frontend\Writing\storeRequest as writingStoreRequest;
use App\Mail\ContactMail;
use App\Mail\ForgetPassword;
use App\Mail\signupMail;
use App\Models\AdditionalCertificate;
use App\Models\Award;
use App\Models\BoardComitteeMember;
use App\Models\Category;
use App\Models\Directorship;
use App\Models\Education;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\ProfessionalExperience;
use App\Models\Publication;
use App\Models\RefreshYourDTP;
use App\Models\SectionItem;
use App\Models\Skill;
use App\Models\Speaking;
use App\Models\User;
use App\Models\UserSkill;
use App\Models\Writing;
use App\Services\AddtionalCertificateServices;
use App\Services\AwardServices;
use App\Services\BioProfileServices;
use App\Services\BoardMemberServices;
use App\Services\DirectorShipServices;
use App\Services\EducationServices;
use App\Services\ProExperienceServices;
use App\Services\PublicationServices;
use App\Services\SkillServices;
use App\Services\UserAuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{

    public function __construct(
        protected UserAuthService $authService,
        protected EducationServices $educationService,
        protected BioProfileServices $bioProfileServices,
        protected ProExperienceServices $professionalexperienceService,
        protected SkillServices $skillService,
        protected DirectorShipServices $directorshipServices,
        protected BoardMemberServices $boardmember,
        protected AddtionalCertificateServices $additionalCertificate,
        protected PublicationServices $publicationServices,
        protected AwardServices $awardServices,

    ) {}



    

    public function index()
    {
        
        return view('frontend.index');
    }

    public function register(RegisterRequest $request)
    {
        try {

            $user = $this->authService->register($request->all());
            $data = $request->all();
            $id = User::where('email', $request->email)->select('id')->first();
            $encryptedValue = Crypt::encryptString($id->id);
            $data['id'] = $encryptedValue;
            $data['email'] = $request->email;
            $data['name'] = $request->name;
            $data['phone_number'] = $request->phone_number;
            $data['trans_amount'] = 6;
            Mail::to($request->email)->send(new signupMail($data));
            //return view('frontend.payment.payment',['user'=>$data]);
            return redirect()->back()->with('success', 'Registration completed successfully, but you need to subscribe on this website; otherwise, your account will not be saved!.');
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return redirect()->back()->with('error', "Something went wrong!", $th->getMessage());
        }
    }

    // Store the new category
    public function login(Request $request)
    {
        try {
            // Attempt to log in using the AuthService
            $user = $this->authService->login($request->all());

            if (!$user) {
                return redirect()->back()->with('error', 'Invalid credentials!');
            }

            if ($user && $user->is_paid == 0) {
                return redirect()->back()->with('error', 'Kindly make the payment first. You will then be eligible to log in and pay using the email that was sent to you!');
            }

            // Fetch the user from the database
            $user = User::where('email', $request->email)->first();

            if ($user) {
                Auth::guard('web')->login($user);
                return redirect()->back()->with('success', 'Login successful!');
            } else {
                return redirect()->back()->with('error', 'User not found!');
            }
        } catch (\Exception $e) {
            // Catch any unexpected error
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }


    public function checkLogin(Request $request)
    {
        if (Auth::guard('web')->user()->name) {
            dd('User logged in', Auth::guard('web')->user()->name);
        }
    }



    // Show a single category with its products
    public function show(Category $category)
    {
        $category->load('products.user');

        return view('categories.show', compact('category'));
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('manager.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->products()->detach(); // Detach all related products
        $category->delete();

        return redirect()->route('manager.categories.index')->with('success', 'Category deleted successfully.');
    }
    public function verifyEmail($id)
    {
        $id = Crypt::decryptString($id);
        $trans_amount = env('SIGN_UP_TRANSMITED_AMOUNT');
        session(['user_id' => $id]);
        session(['trans_amount' => $trans_amount]);
        $user_found = User::where('id', $id)->first();
        if ($user_found && $user_found->is_paid == 1) {
            return redirect()->route('frontend.home.page')->with('error', 'The user has already paid for the subscription and has also signed up with this email address!');
        } elseif (!$user_found) {
            return redirect()->route('frontend.home.page')->with('error', '"Kindly sign up again, as the system could not find your account!');
        }
        return view('frontend.payment.payment')->with(['user' => $user_found, 'trans_amount' => $trans_amount]);
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('frontend.home.page')->with('success', 'You have been logged out successfully.');
    }



    public function forgetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found with that email');
        }
        $encryptedValue = Crypt::encryptString($user->id);
        $user['encrypted_id'] = $encryptedValue;
        Mail::to($request->email)->send(new ForgetPassword($user));
        return redirect()->back()->with('success', 'Your password reset request was successful! Please check your email to reset your password.');
    }
    public function resetPassword($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        return view('frontend.password.change', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',       // minimum 8 characters
                'confirmed',   // must match password_confirmation
                'regex:/[a-z]/',      // at least one lowercase letter
                'regex:/[A-Z]/',      // at least one uppercase letter
                'regex:/[0-9]/',      // at least one number
                'regex:/[@$!%*?&]/',  // at least one special character
            ]
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password and Confirm Password do not match',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('frontend.home.page')->with('success', 'Your password has been updated successfully! Please login with your new password.');
    }

    public function editProfile()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('frontend.home.page');
        }
        $user = User::with('bioProfile')->where('id', Auth::guard('web')->user()->id)->first();
        return view('frontend.profile-form', ['user' => $user]);
    }
    public function updateProfile(Request $request)
    {

        $basic_info = [];
        $bio_info = [];



        // add basic info
        $basic_info['name'] = $request->name;
        $basic_info['phone_number'] = $request->phone_number;
        $basic_info['gender'] = $request->gender;
        $basic_info['nationality'] = $request->nationality;
        $basic_info['cnic_or_passport'] = $request->cnic_or_passport;
        $basic_info['date_of_birth'] = $request->date_of_birth;
        $basic_info['profile_picture'] = $request->profile_picture;
        $basic_info['residential_address'] = $request->residential_address;
        $basic_info['introduction'] = $request->introduction;
        $basic_info['professional'] = $request->professional;
        $basic_info['user_id'] = Auth::guard('web')->user()->id;


        //   add bio info
        $bio_info['bio_summary'] = $request->bio_summary;
        $bio_info['linkedin_url'] = $request->linkedin_url;
        $bio_info['website_url'] = $request->website_url;
        $bio_info['facebook_url'] = $request->facebook_url;
        $bio_info['twitter_url'] = $request->twitter_url;
        $bio_info['instagram_url'] = $request->instagram_url;
        $bio_info['user_id'] = Auth::guard('web')->user()->id;



        // eduction info


        if (isset($basic_info)) {
            $user = $this->bioProfileServices->updatePersonalInfo($basic_info);
        }

        if (isset($bio_info)) {
            $user = $this->bioProfileServices->update($bio_info);
        }
        return redirect()->back()->with('success', 'Profile Update SuccessFully');
    }
    public function addEducationList()
    {

        $education_data = Education::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.education', ['education_data' => $education_data]);
    }
    // public function addExperienceList()
    // {

    //     $education_data = ProfessionalExperience::where('user_id', Auth::guard('web')->user()->id)->get();
    //     return view('frontend.profile.addExperienceList', ['education_data' => $education_data]);
    // }
    public function saveEducation(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->educationService->store($data);
        return 'success';
    }
    public function deleteEducation(Request $request)
    {
        $data = $this->educationService->delete(intval($request->educationId));
        return 'success';
    }
    public function saveExperience(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->professionalexperienceService->store($data);
        return 'success';
    }

    public function experienceList()
    {
        $experience_list = ProfessionalExperience::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.experience', ['experience_list' => $experience_list]);
    }
    public function experienceDelete(Request $request)
    {
        $data = $this->professionalexperienceService->delete($request->Id);
        return true;
    }

    public function skills()
    {
        $skill = UserSkill::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.skill', ['skill' => $skill]);
    }
    public function saveSkill(Request $request)
    {
        $info = $request->all();

        $check_duplicate = UserSkill::where('user_id', Auth::guard('web')->user()->id)->where('name', $request->name)->first();
        if ($check_duplicate) {
            return 'false';
        }
        $info['user_id'] = Auth::guard('web')->user()->id;

        $data = $this->skillService->storeUserSkill($info);
        return true;
    }
    public function deleteSkill(Request $request)
    {
        $skill = UserSkill::where('id', $request->id)->delete();
        return true;
    }
    public function saveDirector(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->directorshipServices->store($data);
        return 'success';
    }
    public function directorList(Request $request)
    {
        $director_data = Directorship::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.director', ['director_data' => $director_data]);
    }



    public function saveBoardMember(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->boardmember->store($data);
        return 'success';
    }
    public function boardList(Request $request)
    {
        $board_data = BoardComitteeMember::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.board', ['board_data' => $board_data]);
    }
    public function boardDelete(Request $request)
    {

        $board_data = BoardComitteeMember::where('id', $request->Id)->delete();
        return 'success';
    }

    public function saveAdditionCertificate(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->additionalCertificate->store($data);
        return 'success';
    }

    public function certificateList(Request $request)
    {
        $certificate_data = AdditionalCertificate::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.certified', ['certificate_data' => $certificate_data]);
    }

    public function certificateDelete(Request $request)
    {
        $certificate_data = AdditionalCertificate::where('id', $request->Id)->delete();
        return true;
    }
    public function directorDelete(Request $request)
    {

        $certificate_data = Directorship::where('id', $request->directorId)->delete();
        return true;
    }


    public function savePublications(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->publicationServices->store($data);
        return 'success';
    }
    public function publicationList()
    {

        $publication_list = Publication::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.publication', ['publication_list' => $publication_list]);
    }


    public function publicationDelete(Request $request)
    {

        $certificate_data = Publication::where('id', $request->id)->delete();
        return true;
    }



    public function saveAward(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        $data = $this->awardServices->store($data);
        return 'success';
    }

    public function AwardList()
    {
        $award = Award::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('frontend.profile.list.award', ['award' => $award]);
    }

    public function AwardDelete(Request $request)
    {
        $data = $this->awardServices->delete($request->Id);
        return true;
    }

    public function directorMeetEvent(Request $request)
    {
        return view('frontend.director_meet_event');
    }
    public function speeking(Request $request)
    {
        return view('frontend.speeking');
    }
    public function refresh_your_dtp(Request $request)
    {
        return view('frontend.refresh_your_dtp');
    }
    public function writing(Request $request)
    {
        return view('frontend.writing');
    }
    public function resource_library(Request $request)
    {
        $page = Page::where('slug','resource_library')
        ->where('status',1)
        ->with(['sections'])
        ->firstOrFail();

        return view('frontend.resource_library',compact('page'));
    }
    public function sectionShow($slug)
    {
        $sectionItem = PageSection::with('items')
                        ->where('slug', $slug)->firstOrFail();

        return view('frontend.resource-library.section-detail', compact('sectionItem'));
    }

    public function forum(Request $request)
    {
        return view('frontend.forum');
    }
    public function aboutUs(Request $request)
    {
        return view('frontend.about-us');
    }
    public function contactUs(Request $request)
    {
        return view('frontend.contact');
    }
    public function calendar(Request $request)
    {

        return view('frontend.calendar');
    }
    public function calendarView()
    {

        return view('frontend.calendarView');
    }
    public function Storespeeking(storeRequest $request)
    {
        if (!Auth::guard('web')->user()) {
            return redirect()->back()->with('error', 'Kindly log in first, then proceed further.!');
        }
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        Speaking::create($data);
        return redirect()->back()->with('success', 'You have successfully submitted the request to speak. Please wait for admin approval!');
    }
    public function Storewriting(writingStoreRequest $request)
    {
        if (!Auth::guard('web')->user()) {
            return redirect()->back()->with('error', 'Kindly log in first, then proceed further.!');
        }
        $data = $request->all();
        $data['user_id'] = Auth::guard('web')->user()->id;
        Writing::create($data);
        return redirect()->back()->with('success', 'You have successfully submitted the request to writing. Please wait for admin approval!');
    }


    public function uploadContact(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['subject'] = $request->subject;
        Mail::to(env('CONTACT_EMAIL'))->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Your email has been sent to the PICG team. They will respond to you shortly.');
    }
    // Khalid Controller Start 

    public function corporatelaws(Request $request)
    {
        return view('frontend.resource-library.corporate-laws');
    }

    public function sustainably(Request $request)
    {
        return view('frontend.resource-library.sustainably');
    }

    public function soesgovernmententities(Request $request)
    {
        return view('frontend.resource-library.soes-government-entities');
    }

    public function sectorspecificlaws(Request $request)
    {
        return view('frontend.resource-library.sector-specific-laws');
    }

    public function reportingstandards(Request $request)
    {
        return view('frontend.resource-library.reporting-standards');
    }

    public function report(Request $request)
    {
        return view('frontend.resource-library.report');
    }

    public function picgthoughtleadership(Request $request)
    {
        return view('frontend.resource-library.picg-thought-leadership');
    }

    public function picgquorum(Request $request)
    {
        return view('frontend.resource-library.picg-quorum');
    }

    public function oecd(Request $request)
    {
        return view('frontend.resource-library.oecd');
    }

    public function esg(Request $request)
    {
        return view('frontend.resource-library.esg');
    }

    public function bestpractices(Request $request)
    {
        return view('frontend.resource-library.best-practices');
    }

    public function aicybersecurity(Request $request)
    {
        return view('frontend.resource-library.ai-cybersecurity');
    }

    public function freediscountedworkshops(Request $request)
    {
        return view('frontend.free-discounted-workshops');
    }

    public function directorsmeetsevents(Request $request)
    {
        return view('frontend.directors-meets-events');
    }


    //   Khalid End


    public function uploadRefreshyourdtp(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone'       => 'required|digits:11|starts_with:03',
            'dtp'         => 'required|string|max:255',
            'esg'         => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        RefreshYourDTP::create($validated);
        return redirect()->back()->with('success', 'DTP data stored successfully!');
    }
}
