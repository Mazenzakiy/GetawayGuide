<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\Category;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\Preference;
use App\Models\PreferenceOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

Admin::create([
    "name"=>"mazen adel",
    "email"=>"mazenzaky153@gmail.com",
    "password"=>"mazenzaky153@gmail.com",
]);

$country = Country::create([
    "name" => 'Egypt',
    "population" => '500',
    "territory" => '254',
    "avg_price" => '0',
    "description" => 'welcome to egypt',
    "image" => 'Egypt.jpg',
    "continent" => 'africa',
]);


/**
 *
 * "name":"Giza ",
 * "image":"aswan.jpeg"
 * ,"price":"100"
 * ,"num_days":"13"
 * ,"country_id":"1"
 * "video":"Let s Go - Egypt _ A Beautiful Destinations Original.mp4"},
 */

$city= City::create([
"name"=>"Giza ",
"image"=>"aswan.jpeg",
"price"=>"100",
"num_days"=>"13",
"country_id"=>"1",
"video"=>"Let s Go - Egypt _ A Beautiful Destinations Original.mp4",
]);

        // Example Preferences
$preference1 = Preference::create([
    'question' => 'What type of activities do you enjoy?',
    'type' => 'multiple',  // multiple choice
]);

$preference2 = Preference::create([
    'question' => 'What kind of landmarks are you interested in?',
    'type' => 'single',  // single choice
]);

$preference3 = Preference::create([
    'question' => 'Do you prefer crowded places?',
    'type' => 'single',  // yes or no
]);

$preference4 = Preference::create([
    'question' => 'What time of day do you prefer exploring landmarks?',
    'type' => 'single',  // single choice
]);

// Example Categories (for classifying landmarks)
$historical = Category::create(['name' => 'Historical']);
$recreational = Category::create(['name' => 'Recreational']);
$cultural = Category::create(['name' => 'Cultural']);
$natural = Category::create(['name' => 'Natural']);
$crowded = Category::create(['name' => 'Crowded']);
$calm = Category::create(['name' => 'Calm']);

// Preference Options (for multiple choice)
PreferenceOption::create([
    'preference_id' => $preference1->id,
    'option' => 'Museums',
    'category_id' => $cultural->id,  // Links to 'Cultural' landmarks
]);

PreferenceOption::create([
    'preference_id' => $preference1->id,
    'option' => 'Hiking Trails',
    'category_id' => $natural->id,  // Links to 'Natural' landmarks
]);

// Preference Options (for single choice)
PreferenceOption::create([
    'preference_id' => $preference2->id,
    'option' => 'Historical Sites',
    'category_id' => $historical->id,  // Links to 'Historical' landmarks
]);

PreferenceOption::create([
    'preference_id' => $preference2->id,
    'option' => 'Parks',
    'category_id' => $recreational->id,  // Links to 'Recreational' landmarks
]);

// Preference Options (for crowded or calm places)
PreferenceOption::create([
    'preference_id' => $preference3->id,
    'option' => 'Yes, I enjoy crowded places',
    'category_id' => $crowded->id,  // Links to 'Crowded' landmarks
]);

PreferenceOption::create([
    'preference_id' => $preference3->id,
    'option' => 'No, I prefer quiet places',
    'category_id' => $calm->id,  // Links to 'Calm' landmarks
]);

// Preference Options (for time of day)
PreferenceOption::create([
    'preference_id' => $preference4->id,
    'option' => 'Morning',
    'category_id' => null,  // Can be used for further filtering if needed
]);

PreferenceOption::create([
    'preference_id' => $preference4->id,
    'option' => 'Evening',
    'category_id' => null,  // Can be used for further filtering if needed
]);

    }
}
