<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Cuisine;
 
class CuisineSeeder extends Seeder
{
    public function run()
    {
        $cuisines = [
            'Andhra Style', 'Awadhi', 'Bengali', 'Chettinad Style',
            'Gujarati (Kathiyawadi)', 'Iyengar (Tamil Brahmin)',
            'Jain Household Cuisine', 'Karnataka Style', 'Konkani Style',
            'Malabar Style', 'Malvani Style', 'Maharashtrian',
            'Odia', 'Punjabi', 'Rajasthani',
            'Tamil Brahmin (Iyer) Style', 'Udupi Style', 'Uttara Kannada (Karavali) Style'
        ];
 
        foreach ($cuisines as $name) {
            Cuisine::create([
                'name' => $name,
                'status' => 'Active',
            ]);
        }
    }
}