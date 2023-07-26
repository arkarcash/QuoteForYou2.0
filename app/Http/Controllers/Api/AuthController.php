<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserResource;
use App\Models\Certificate;
use App\Models\Fcmtokenkey;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    use ResponseHelper;

    public function detail()
    {
        $user = User::with('certificate')->where('id',Auth::guard('sanctum')->id())->first();
        return UserDetailResource::make($user);
    }
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255','unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fcm_token_key' => ['required']
        ]);


        if($validate->fails()){
            if (isset($validate->failed()['name'])){
                return $this->fail('Name Required');
            }
            if (isset($validate->failed()['email']['Unique'])){
                return $this->fail($request->email.' Already Taken');
            }
            if (isset($validate->failed()['email'])){
                return $this->fail(' Email Required');
            }
            if (isset($validate->failed()['password']['Confirmed'])){
                return $this->fail('Password Confirmation Error');
            }
            if (isset($validate->failed()['fcm_token_key'])){
                return $this->fail('FCM Token Required');
            }
            return $this->fail( $validate->getMessageBag());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('api_user')->plainTextToken;
        $this->insertToken($request->fcm_token_key,$user->id);

        Auth::login($user);

        $certificate = new Certificate();
        $certificate->user_id = Auth::id();
        $certificate->save();


        return response()->json(['status' => true , 'data' => UserResource::make(Auth::user()->refresh()) ,'token' => $token]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'fcm_token_key' => ['required']
        ]);


        if ($validate->fails()){
            if (isset($validate->failed()['email'])){
                return $this->fail('Email Required');
            }
            if (isset($validate->failed()['password'])){
                return $this->fail('Password Required');
            }
            if (isset($validate->failed()['fcm_token_key'])){
                return $this->fail('FCM Token Required');
            }
            return $this->fail( $validate->getMessageBag());

        }

        if($validate->fails()){
            return response()->json(['data' => $validate->getMessageBag()]);
        }

        if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){

            $this->insertToken($request->fcm_token_key,Auth::id());

            $token = Auth::guard('sanctum')->user()->createToken('api_user')->plainTextToken;
            return response()
                ->json(['status' => true,'token' => $token, 'data' => UserResource::make(Auth::guard('sanctum')->user())]);
        }else{
            return $this->fail('Something Was Wrong!');
        }

    }

    public function addPoint()
    {
        $user = User::where('id',Auth::id())->first();
        $user->increment('points',1);

        $certificate = Certificate::where('user_id',Auth::guard('sanctum')->id())->first();
        if ($certificate == null){
            $certificate = new Certificate();
            $certificate->user_id = $user->id;
            $certificate->save();
        }
        $fontForLevelOneToFive = 'BRUSHSCI.ttf';
        $fontForLevelFiveToTen = 'TransformersMovie-y9Ad.ttf';
        $fontSizeForLevelOneToFive = 350;
        $fontSizeForLevelFiveToTen = 300;
        $leftDateWidthForLevelFiveToTen = 3.95;
        $leftDateWidthForLevelOneToFive = 2.85;
        $bgFrames = [
            '1.-QFY-CONTRIBUTOR-(FOR-APP).png',
            '2.-QFY-RISING-STAR-(FOR-APP).png',
            '3.-QFY-GURU-(FOR-APP).png',
            '4.-QFY-MENTOR-(FOR-APP).png',
            '5.-QFY-MYSTERY-(FOR-APP).png',
            '6.-QFY-(Creator)-(FOR-APP).png',
            '7.-QFY-(Specialist)-(FOR-APP).png',
            '8.-QFY-(Collaborator)-(FOR-APP).png',
            '9.-QFY-(Authority)-(FOR-APP).png',
            '10.-QFY-(Legend)-(FOR-APP).png'
        ];

        switch ($user->points){
            case 500:
                if ($certificate->contributor == null ){
                    $user->photo = '1_contributor.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[0]);
                    self::makeCertificate($certificateBg,$certificate,'contributor',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive);
                }
            break;
            case 1500:
                if ($certificate->rising_star == null ){
                    $user->photo = '2_rising_star.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[1]);
                    self::makeCertificate($certificateBg,$certificate,'rising_star',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive);
                }
                break;
            case 3000:
                if ($certificate->guru == null ){
                    $user->photo = '3_mentor.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[2]);
                    self::makeCertificate($certificateBg,$certificate,'mentor',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive);
                }
                break;
            case 6000:
                if ($certificate->mentor == null ){
                    $user->photo = '4_guru.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[3]);
                    self::makeCertificate($certificateBg,$certificate,'guru',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive);
                }
                break;
            case 10000:
                if ($certificate->mystery == null ){
                    $user->photo = '5_mystery.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[4]);
                    self::makeCertificate($certificateBg,$certificate,'mystery',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive);
                }
                break;
            case 20000:
                if ($certificate->creator == null ){
                    $user->photo = '6_Creator.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[5]);
                    self::makeCertificate($certificateBg,$certificate,'creator',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen);
                }
                break;
            case 40000:
                if ($certificate->specialist == null ){
                    $user->photo = '7_Specialist.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[6]);
                    self::makeCertificate($certificateBg,$certificate,'specialist',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen);
                }
                break;
            case 80000:
                if ($certificate->collaborator == null ){
                    $user->photo = '8_Collaborator.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[7]);
                    self::makeCertificate($certificateBg,$certificate,'collaborator',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen);
                }
                break;
            case 130000:
                if ($certificate->authority == null ){
                    $user->photo = '9_Authority.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[8]);
                    self::makeCertificate($certificateBg,$certificate,'authority',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen);
                }
                break;
            case 200000:
                if ($certificate->legend == null ){
                    $user->photo = '10_Legend.png';
                    $user->update();
                    $certificateBg = Image::make('CertificateFrame/'.$bgFrames[9]);
                    self::makeCertificate($certificateBg,$certificate,'legend',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen);
                }
                break;
        }

        return $this->success(UserResource::make(Auth::user()->refresh()));
    }

    public static function makeCertificate($imagePath,$certificate,$levelName,$customFont,$fontSize,$leftWidth)
    {
        if(!Storage::exists("public/certificates")){
            Storage::makeDirectory("public/certificates");
        }

        $uniqueID = "CLICK_FOR_FREEDOM_".Str::orderedUuid();
        $name = Str::ucfirst(Auth::guard('sanctum')->user()->name);
        $date = now()->format('d F, Y');
        $main = $imagePath
            ->text($name, $imagePath->width() / 2, $imagePath->height() / 1.6, function($font)  use ($customFont,$fontSize){
            $font->file(public_path('Fonts/'.$customFont));
            $font->size((int)$fontSize);
            $font->align('center');
            $font->color('#DB4E54');
        })
            ->text($date, $imagePath->width()  / $leftWidth, $imagePath->height() / 1.13,function ($font) use ($customFont){
            $font->file(public_path('Fonts/BRUSHSCI.ttf'));
            $font->size(80);
            $font->color('#306FB6');
        });

        $path = public_path('storage/certificates/');
        $name = $path.$uniqueID.'.png';
        $main->save($name,100);

        $certificate->$levelName = $uniqueID.'.png';
        $certificate->update();

        return true;

    }

    public function logout()
    {
        $user = User::where('id',Auth::guard('sanctum')->id())->first();
        $user->tokens()->delete();
        return $this->success('Successfully Logout!');
    }

    public function deleteUser($id)
    {
        $user = User::where('id',$id)->first();

        if(!$user){
            return $this->fail('User Not Found');
        }

        $user->delete();

        return $this->success("$user->name is deleted!");

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::where('id',Auth::guard('sanctum')->id())->first();

        if (Hash::check($request->old_password,$user->password)){

            $user->password = Hash::make($request->password);
            $user->update();

            return $this->success( 'Successfully Password Changed');

        }

        return $this->fail('Old Password Not Match');

    }

    public function insertToken($token,$user_id)
    {
        //insert token
        $raw = Fcmtokenkey::where('user_id',$user_id);

        if($raw->count() >= 5){
            $oldToken = $raw->first();
            $oldToken->delete();
        }

        if($raw->where('token',$token)->exists()){
            return true;
        }


        $newToken = new Fcmtokenkey();
        $newToken->user_id = $user_id;
        $newToken->token = $token;
        $newToken->save();

        return true;
    }
}


