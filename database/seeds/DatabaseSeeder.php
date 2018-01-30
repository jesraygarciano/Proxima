<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Intern;
use App\Resume;
use App\Company;
use App\Opening;
use App\User;
use App\Scout;
use App\Opening_skill;
use App\Resume_skill;
use App\Application;
use App\Joining_opening_skill;
use App\Joining_resume_skill;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            $this->call('UsersTableSeeder');
            $this->call('ResumesTableSeeder');
            $this->call('CompaniesTableSeeder');
            $this->call('OpeningsTableSeeder');
            $this->call('ApplicationsTableSeeder');
            $this->call('ScoutsTableSeeder');
            $this->call('JoiningResumeSkillsTableSeeder');
            $this->call('JoiningOpeningSkillsTableSeeder');
            $this->call('OpeningsFillCountryProvinceColumnSeeder');


        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('users')->delete();  // ④

        $gender = ['female', 'male'];
        // $role = ['0', '1', '2'];
        // 0 = student, 1 = hiring , 2 = website manager
        // $is_active = ['0', '1'];
        // 0 = deleted, 1 = alive
        $graduate_flag = ['0', '1'];
        // 0 = under graduate 1 = graduated

        $faker = Faker::create('en_US');  // ⑤
        for ($i = 1; $i < 201; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            User::create([
                'email' => $faker->email(),
                'password' => $faker->password(),
                'role' => '0',
                'f_name' => $faker->firstName,
                'l_name' => $faker->lastName,
                'm_name' => $faker->firstName,
                'phone_number' => $faker->phoneNumber(),
                'photo' => $faker->lexify('photo_???????????.png'),
                'is_active' => '1',
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
        }

        for ($i = 201; $i < 301; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            User::create([
                'email' => $faker->email(),
                'password' => $faker->password(),
                'role' => '1',
                'f_name' => $faker->firstName,
                'l_name' => $faker->lastName,
                'm_name' => $faker->firstName,
                'phone_number' => $faker->phoneNumber(),
                'photo' => $faker->lexify('photo_???????????.png'),
                'is_active' => '1',
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
        }
    }
}

class ResumesTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('resumes')->delete();  // ④

        $graduate_flag = ['0', '1'];
        $gender = ['female', 'male'];
        $marital_status = ['single', 'married'];

        $is_active = ['0', '1', '1'];
        $is_master = ['0', '1', '1'];

        // 0 = deleted, 1 = alive

        // $user_id = ['1', '2', '3', '4', '5'];
        $user_id = array();
        for ($i = 1; $i < 201; $i++) {
            $user_id[] = $i;
        }

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 301; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Resume::create([
                'phone_number' => $faker->phoneNumber(),
                'user_id' => $faker->randomElement($user_id),
                'email' => $faker->email(),
                'objective' => $faker->text($maxNbChars = 500),
                'nationality' => $faker->country(),
                'birth_date' => $datetime->format('Y-m-d H:i:s'),
                'gender' => $faker->randomElement($gender),
                'postal' => $faker->postcode(),
                'address1' => $faker->streetAddress(),
                'address2' => $faker->streetName(),
                'city' => $faker->city(),
                'country' => $faker->country(),
                'phone_number' => $faker->phoneNumber($maxNbChars = 8),
                'religion' => $faker->lexify('religion_???????'),
                'summary' => $faker->text($maxNbChars = 400), 
                'other_skills' => $faker->text($maxNbChars = 400),
                'websites' => $faker->text($maxNbChars = 400),
                'seminars_attended' => $faker->text($maxNbChars = 400),
                'awards' => $faker->text($maxNbChars = 400),
                'spoken_language' => $faker->lexify('spoken_language_???????'),
                'experience' => $faker->lexify('spoken_language_???????'),
                'marital_status' => $faker->randomElement($marital_status),
                'created_at' => $datetime,
                'updated_at' => $datetime,
                'graduate_flag' => $faker->randomElement($graduate_flag),
                'is_active' => $faker->randomElement($is_active),
                'is_master' => $faker->randomElement($is_master)


            ]);
        }
    }
}

class CompaniesTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('companies')->delete();  // ④

        // $is_active = ['0', '1'];
        // 0 = deleted, 1 = alive

        // $user_id = ['1', '2', '3', '4', '5'];
        $user_id = array();
        for ($i = 201; $i < 301; $i++) {
            $user_id[] = $i;
        }

        // var_export($user_id);

        $faker = Faker::create('en_US');  // ⑤
        for ($i = 1; $i < 101; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            $company_name = $faker->company();
            // var_export($company_name);
            Company::create([
                'company_name' => $company_name,
                'email' => $faker->email(),
                'password' => $faker->password(),
                'in_charge' => $faker->name(),
                'ceo_name' => $faker->name(),
                'address1' => $faker->streetAddress(),
                'address2' => $faker->streetName(),
                'city' => $faker->city(),
                'country' => $faker->country(),
                'postal' => $faker->postcode(),
                'url' => $faker->url(),
                'tel' => $faker->phoneNumber(),
                'number_of_employee' => $faker->numberBetween($min = 10, $max = 9000),
                'established_at' => $faker->date(),
                'facebook_url' => $faker->lexify('??????'),
                'twitter_url' => $faker->lexify('???????????'),
                'company_logo' => $faker->lexify('company???????????.jpg'),
                'background_photo' => $faker->lexify('back???????????.jpg'),
                'company_introduction' => $faker->text($maxNbChars = 300),
                'what' => $faker->text($maxNbChars = 500),
                'what_photo1' => $faker->lexify('what_photo1???????????.png'),
                'what_photo1_explanation' => $faker->text($maxNbChars = 400),
                'what_photo2' => $faker->lexify('what_photo2???????????.png'),
                'what_photo2_explanation' => $faker->text($maxNbChars = 400),
                'bill_company_name' => $company_name,
                'bill_postal' => $faker->postcode(),
                'bill_address1' => $faker->streetAddress(),
                'bill_address2' => $faker->streetName(),
                'bill_city' => $faker->city(),
                'bill_country' => $faker->country(),
                'is_active' => '1',
                // 'user_id' => $faker->'1',
                'user_id' => $faker->randomElement($user_id),
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
        }
    }
}

class OpeningsTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('openings')->delete();  // ④

        // $is_active = ['0', '1', '1', '1', '1', '1'];
        $hiring_type = ['0', '0', '0', '1', '1', '2'];
        $featured_status = ['0', '0', '0', '1', '1'];
        $salary_range = ['1', '2', '2', '2', '2', '2', '3', '3', '3', '3', '3', '3', '4', '4', '4', '5', '5', '6', '6', '7', '8', '9', '10'];

        // $company_id = ['5', '6', '7', '8', '9'];
        $company_id = array();
        for ($i = 1; $i < 101; $i++) {
            $company_id[] = $i;
        }

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 301; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Opening::create([
                'title' => $faker->lexify('title_????????????????????????????????????????????????????'),
                'address1' => $faker->streetAddress(),
                'address2' => $faker->streetName(),
                'city' => $faker->city(),
                'country' => $faker->country(),
                'postal' => $faker->postcode(),
                'picture' => $faker->url(),
                'icon' => $faker->url(),
                'details' => $faker->sentence(),
                'requirements' => $faker->sentence(),
                'term' => $faker->sentence(),
                'other' => $faker->sentence(),
                'is_active' => '1',
                'company_id' => $faker->randomElement($company_id),
                'hiring_type' => $faker->randomElement($hiring_type),
                'featured_status' => $faker->randomElement($featured_status),
                'salary_range' => $faker->randomElement($salary_range),
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
        }
    }
}

class ApplicationsTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('applications')->delete();  // ④

        $is_active = ['0', '1', '1', '1', '1', '1'];

        $user_id = array();
        for ($i = 1; $i < 101; $i++) {
            $user_id[] = $i;
        }

        $opening_id = array();
        for ($i = 1; $i < 301; $i++) {
            $opening_id[] = $i;
        }

        $resume_id = array();
        for ($i = 1; $i < 301; $i++) {
            $resume_id[] = $i;
        }        

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 101; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Application::create([

                'is_active' => $faker->randomElement($is_active),
                'description' => $faker->sentence(),
                'user_id' => $faker->randomElement($user_id),
                'opening_id' => $faker->randomElement($opening_id),
                'resume_id' => $faker->randomElement($resume_id),                
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
        }
    }
}

class ScoutsTableSeeder extends Seeder  // ③
{
    public function run()
    {

        DB::table('scouts')->delete();
          // ④
        $is_active = ['0', '1'];

        $user_id = array();
        for ($i = 1; $i < 201; $i++) {
            $user_id[] = $i;
        }

        $company_id = array();
        for ($i = 1; $i < 101; $i++) {
            $company_id[] = $i;
        }        

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 301; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Scout::create([
                'description' => $faker->sentence(),                
                'is_active' => $faker->randomElement($is_active),
                'user_id' => $faker->randomElement($user_id),
                'company_id' => $faker->randomElement($company_id),                
                'created_at' => $datetime,
                'updated_at' => $datetime
                // 'updated_at' => Carbon::today()
            ]);
        }
    }
}

class JoiningResumeSkillsTableSeeder extends Seeder  // ③
{
    public function run()
    {

        DB::table('joining_resume_skills')->delete();
          // ④
        $resume_id = array();
        for ($i = 1; $i < 301; $i++) {
            $resume_id[] = $i;
        }

        $resume_skill_id = array();
        for ($i = 1; $i < 123; $i++) {
            $resume_skill_id[] = $i;
        }        

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 1001; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Joining_resume_skill::create([
                'resume_id' => $faker->randomElement($resume_id),
                'resume_skill_id' => $faker->randomElement($resume_skill_id),
                'created_at' => $datetime,
                'updated_at' => $datetime
                // 'updated_at' => Carbon::today()
            ]);
        }
    }
}

class JoiningOpeningSkillsTableSeeder extends Seeder  // ③
{
    public function run()
    {

        DB::table('joining_opening_skills')->delete();
          // ④

        $opening_id = array();
        for ($i = 1; $i < 301; $i++) {
            $opening_id[] = $i;
        }

        $opening_skill_id = array();
        for ($i = 1; $i < 123; $i++) {
            $opening_skill_id[] = $i;
        }        

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 1; $i < 1001; $i++) {  // ⑥
            $datetime = $faker->dateTimeThisYear();
            Joining_opening_skill::create([
                'opening_id' => $faker->randomElement($opening_id),
                'opening_skill_id' => $faker->randomElement($opening_skill_id),
                'created_at' => $datetime,
                'updated_at' => $datetime
                // 'updated_at' => Carbon::today()
            ]);
        }
    }
}

class OpeningsFillCountryProvinceColumnSeeder extends Seeder
{
    public function run()
    {
        foreach (Opening::all() as $opening) 
        {
            // default is Philippines - PHL
            $country_code ="PHL";

            // fetch provinces
            $provinces = \DB::table('provinces')->where('country_code','PHL')->get();

            $ran = rand(0,count($provinces) - 1);

            $opening->province_code = $provinces[$ran]->iso_code;
            $opening->country_code = $country_code;
            $opening->save();

        }
    }
}


