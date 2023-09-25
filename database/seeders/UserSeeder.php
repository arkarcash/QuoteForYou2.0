<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



//        $user = User::where('email','hjmm6546@gmail.com')->first();
//        $this->addPoint($user->id);
//        $Cusers = User::get()->take(5);
//
//        foreach ($Cusers as $user){
//            $this->addPoint($user['id']);
//        }
    }

    public function addPoint($id)
    {
        $user = User::where('id',$id)->first();

        $certificate = Certificate::where('user_id',$id)->first();
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
        $leftDateWidthForLevelOnlyFive = 3.2;

        $levelOneToFiveHight = 1.14;
        $levelFiveToTenHight = 1.13;
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

        if ($user->points >= 500 && $certificate->contributor == null){
            $user->photo = '1_contributor.png';
            $user->update();

            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[0]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'contributor',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive,$levelOneToFiveHight);
        }

        if ($user->points >= 1500 && $certificate->rising_star == null ){
            $user->photo = '2_rising_star.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[1]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'rising_star',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive,$levelOneToFiveHight);
        }

        if ($user->points >= 3000 && $certificate->guru == null ){

            $user->photo = '4_guru.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[3]);

            $this->makeCertificate($user->name,$certificateBg,$certificate,'guru',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive,$levelOneToFiveHight);
        }

        if ($user->points >= 6000 && $certificate->mentor == null ){
            $user->photo = '3_mentor.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[2]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'mentor',$fontForLevelOneToFive,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOneToFive,$levelOneToFiveHight);
        }

        if ($user->points >= 10000 && $certificate->mystery == null ){
            $user->photo = '5_mystery.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[4]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'mystery',$fontForLevelFiveToTen,$fontSizeForLevelOneToFive,$leftDateWidthForLevelOnlyFive,$levelOneToFiveHight);
        }

        if ($user->points >= 20000 && $certificate->creator == null ){
            $user->photo = '6_Creator.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[5]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'creator',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen,$levelFiveToTenHight);
        }

        if ($user->points >= 40000 && $certificate->specialist == null ){
            $user->photo = '7_Specialist.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[6]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'specialist',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen,$levelFiveToTenHight);
        }

        if ($user->points >= 80000 && $certificate->collaborator == null ){
            $user->photo = '8_Collaborator.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[7]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'collaborator',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen,$levelFiveToTenHight);
        }

        if ($user->points >= 130000 && $certificate->authority == null ){
            $user->photo = '9_Authority.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[8]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'authority',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen,$levelFiveToTenHight);
        }

        if ($user->points >= 200000 && $certificate->legend == null ){
            $user->photo = '10_Legend.png';
            $user->update();
            $certificateBg = Image::make('public/CertificateFrame/'.$bgFrames[9]);
            $this->makeCertificate($user->name,$certificateBg,$certificate,'legend',$fontForLevelFiveToTen,$fontSizeForLevelFiveToTen,$leftDateWidthForLevelFiveToTen,$levelFiveToTenHight);
        }

        return true;
    }

    public static function makeCertificate($name,$imagePath,$certificate,$levelName,$customFont,$fontSize,$leftWidth,$height)
    {
        if(!Storage::exists("public/certificates")){
            Storage::makeDirectory("public/certificates");
        }

        $uniqueID = "CLICK-FOR-FREEDOM_".Str::orderedUuid();
        $name = Str::ucfirst($name);
        $date = now()->format('d M, Y');



        $main = $imagePath
            ->text($name, $imagePath->width() / 2, $imagePath->height() / 1.6, function($font)  use ($customFont,$fontSize){
                $font->file(public_path('Fonts/'.$customFont));
                $font->size((int)$fontSize);
                $font->align('center');
                $font->color('#DB4E54');
            })
            ->text($date, $imagePath->width()  / $leftWidth, $imagePath->height() / $height,function ($font) use ($customFont){
                $font->file(public_path('Fonts/BRUSHSCI.ttf'));
                $font->size(75);
                $font->color('#306FB6');
            });

        $path = public_path('storage/certificates/');
        $name = $path.$uniqueID.'.png';
        $main->save($name,100);

        $certificate->$levelName = $uniqueID.'.png';
        $certificate->update();

        return true;

    }
}
