<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
                [
                    "id" => 86,
                    "name" => "Action"
                ],
                [
                    "id" => 117,
                    "name" => "Actor & Actress Quotes"
                ],
                [
                    "id" => 93,
                    "name" => "Alone"
                ],
                [
                    "id" => 66,
                    "name" => "Ambition"
                ],
                [
                    "id" => 112,
                    "name" => "Anime Quotes"
                ],
                [
                    "id" => 6,
                    "name" => "Anniversary"
                ],
                [
                    "id" => 160,
                    "name" => "Anything"
                ],
                [
                    "id" => 156,
                    "name" => "army"
                ],
                [
                    "id" => 50,
                    "name" => "Art"
                ],
                [
                    "id" => 78,
                    "name" => "Attitude"
                ],
                [
                    "id" => 51,
                    "name" => "Beautiful"
                ],
                [
                    "id" => 121,
                    "name" => "Beauty"
                ],
                [
                    "id" => 84,
                    "name" => "Beginning"
                ],
                [
                    "id" => 120,
                    "name" => "Believe"
                ],
                [
                    "id" => 8,
                    "name" => "Birthday"
                ],
                [
                    "id" => 107,
                    "name" => "Book"
                ],
                [
                    "id" => 124,
                    "name" => "Born"
                ],
                [
                    "id" => 119,
                    "name" => "Broken-Heart"
                ],
                [
                    "id" => 30,
                    "name" => "Burmese Poems"
                ],
                [
                    "id" => 155,
                    "name" => "Burmese Poems to English Translation"
                ],
                [
                    "id" => 101,
                    "name" => "Burmese Quotes"
                ],
                [
                    "id" => 150,
                    "name" => "Business"
                ],
                [
                    "id" => 73,
                    "name" => "Capitalism"
                ],
                [
                    "id" => 82,
                    "name" => "Chance"
                ],
                [
                    "id" => 59,
                    "name" => "Change"
                ],
                [
                    "id" => 175,
                    "name" => "Communication"
                ],
                [
                    "id" => 72,
                    "name" => "Communism"
                ],
                [
                    "id" => 96,
                    "name" => "Confidence"
                ],
                [
                    "id" => 19,
                    "name" => "Cool"
                ],
                [
                    "id" => 20,
                    "name" => "Courage"
                ],
                [
                    "id" => 145,
                    "name" => "Creatives"
                ],
                [
                    "id" => 102,
                    "name" => "Cute"
                ],
                [
                    "id" => 173,
                    "name" => "Death"
                ],
                [
                    "id" => 63,
                    "name" => "Democracy"
                ],
                [
                    "id" => 167,
                    "name" => "Dependence"
                ],
                [
                    "id" => 128,
                    "name" => "Depression"
                ],
                [
                    "id" => 83,
                    "name" => "Difference"
                ],
                [
                    "id" => 52,
                    "name" => "Dreams"
                ],
                [
                    "id" => 24,
                    "name" => "Education"
                ],
                [
                    "id" => 40,
                    "name" => "Environmental"
                ],
                [
                    "id" => 11,
                    "name" => "Equality"
                ],
                [
                    "id" => 132,
                    "name" => "Exercise"
                ],
                [
                    "id" => 182,
                    "name" => "Expmore"
                ],
                [
                    "id" => 58,
                    "name" => "Failure"
                ],
                [
                    "id" => 168,
                    "name" => "Fairness"
                ],
                [
                    "id" => 67,
                    "name" => "Faith"
                ],
                [
                    "id" => 7,
                    "name" => "Family"
                ],
                [
                    "id" => 46,
                    "name" => "Father"
                ],
                [
                    "id" => 68,
                    "name" => "Fear"
                ],
                [
                    "id" => 74,
                    "name" => "Federalism"
                ],
                [
                    "id" => 70,
                    "name" => "Feel"
                ],
                [
                    "id" => 165,
                    "name" => "Fire"
                ],
                [
                    "id" => 103,
                    "name" => "Fitness"
                ],
                [
                    "id" => 49,
                    "name" => "Food"
                ],
                [
                    "id" => 122,
                    "name" => "Football Players Quotes"
                ],
                [
                    "id" => 127,
                    "name" => "Forgiveness"
                ],
                [
                    "id" => 61,
                    "name" => "Freedom"
                ],
                [
                    "id" => 4,
                    "name" => "Friendship"
                ],
                [
                    "id" => 9,
                    "name" => "Funny"
                ],
                [
                    "id" => 99,
                    "name" => "Future"
                ],
                [
                    "id" => 62,
                    "name" => "Generation"
                ],
                [
                    "id" => 114,
                    "name" => "Girls"
                ],
                [
                    "id" => 76,
                    "name" => "God"
                ],
                [
                    "id" => 21,
                    "name" => "Government"
                ],
                [
                    "id" => 48,
                    "name" => "Graduation"
                ],
                [
                    "id" => 98,
                    "name" => "Great"
                ],
                [
                    "id" => 143,
                    "name" => "Guitar"
                ],
                [
                    "id" => 22,
                    "name" => "Happiness"
                ],
                [
                    "id" => 176,
                    "name" => "Hard Work"
                ],
                [
                    "id" => 115,
                    "name" => "Health"
                ],
                [
                    "id" => 89,
                    "name" => "Heart"
                ],
                [
                    "id" => 141,
                    "name" => "Helen Keller"
                ],
                [
                    "id" => 140,
                    "name" => "Henry David Thoreau"
                ],
                [
                    "id" => 23,
                    "name" => "History"
                ],
                [
                    "id" => 133,
                    "name" => "Hobby"
                ],
                [
                    "id" => 47,
                    "name" => "Home"
                ],
                [
                    "id" => 77,
                    "name" => "Hope"
                ],
                [
                    "id" => 154,
                    "name" => "human right"
                ],
                [
                    "id" => 131,
                    "name" => "Iilly singh"
                ],
                [
                    "id" => 42,
                    "name" => "Imagination"
                ],
                [
                    "id" => 163,
                    "name" => "Injustice"
                ],
                [
                    "id" => 10,
                    "name" => "Inspirational"
                ],
                [
                    "id" => 69,
                    "name" => "Integrity"
                ],
                [
                    "id" => 41,
                    "name" => "Intelligence"
                ],
                [
                    "id" => 136,
                    "name" => "Interest"
                ],
                [
                    "id" => 137,
                    "name" => "Interesting"
                ],
                [
                    "id" => 186,
                    "name" => "Jealous"
                ],
                [
                    "id" => 130,
                    "name" => "Jim Carrey"
                ],
                [
                    "id" => 39,
                    "name" => "Knowledge"
                ],
                [
                    "id" => 184,
                    "name" => "Laboratory"
                ],
                [
                    "id" => 108,
                    "name" => "LDRS"
                ],
                [
                    "id" => 13,
                    "name" => "Leadership"
                ],
                [
                    "id" => 166,
                    "name" => "Liberation"
                ],
                [
                    "id" => 81,
                    "name" => "Lie"
                ],
                [
                    "id" => 2,
                    "name" => "Life"
                ],
                [
                    "id" => 5,
                    "name" => "Love"
                ],
                [
                    "id" => 53,
                    "name" => "Marriage"
                ],
                [
                    "id" => 27,
                    "name" => "Medical"
                ],
                [
                    "id" => 116,
                    "name" => "Medicine"
                ],
                [
                    "id" => 54,
                    "name" => "Memorial Day"
                ],
                [
                    "id" => 179,
                    "name" => "Memories"
                ],
                [
                    "id" => 87,
                    "name" => "Mind"
                ],
                [
                    "id" => 181,
                    "name" => "Miss"
                ],
                [
                    "id" => 110,
                    "name" => "Missing"
                ],
                [
                    "id" => 161,
                    "name" => "Mistake"
                ],
                [
                    "id" => 75,
                    "name" => "Modern"
                ],
                [
                    "id" => 45,
                    "name" => "Mom"
                ],
                [
                    "id" => 55,
                    "name" => "Money"
                ],
                [
                    "id" => 79,
                    "name" => "Morning"
                ],
                [
                    "id" => 104,
                    "name" => "Mother"
                ],
                [
                    "id" => 180,
                    "name" => "Mother day"
                ],
                [
                    "id" => 178,
                    "name" => "Motivation"
                ],
                [
                    "id" => 1,
                    "name" => "Motivational"
                ],
                [
                    "id" => 35,
                    "name" => "Movies"
                ],
                [
                    "id" => 29,
                    "name" => "Music"
                ],
                [
                    "id" => 172,
                    "name" => "My Life"
                ],
                [
                    "id" => 105,
                    "name" => "Natural"
                ],
                [
                    "id" => 31,
                    "name" => "Nature"
                ],
                [
                    "id" => 170,
                    "name" => "Negative"
                ],
                [
                    "id" => 142,
                    "name" => "New Year"
                ],
                [
                    "id" => 65,
                    "name" => "Opportunity"
                ],
                [
                    "id" => 174,
                    "name" => "Pain"
                ],
                [
                    "id" => 171,
                    "name" => "Past"
                ],
                [
                    "id" => 56,
                    "name" => "Patience"
                ],
                [
                    "id" => 34,
                    "name" => "Peace"
                ],
                [
                    "id" => 97,
                    "name" => "Perfection"
                ],
                [
                    "id" => 129,
                    "name" => "Pete wentz"
                ],
                [
                    "id" => 106,
                    "name" => "Philosophy"
                ],
                [
                    "id" => 125,
                    "name" => "Poems"
                ],
                [
                    "id" => 18,
                    "name" => "Politics"
                ],
                [
                    "id" => 159,
                    "name" => "Poor"
                ],
                [
                    "id" => 33,
                    "name" => "Positive"
                ],
                [
                    "id" => 3,
                    "name" => "Power"
                ],
                [
                    "id" => 64,
                    "name" => "Progress"
                ],
                [
                    "id" => 147,
                    "name" => "Rainbow"
                ],
                [
                    "id" => 185,
                    "name" => "Rainy Day"
                ],
                [
                    "id" => 169,
                    "name" => "Reality"
                ],
                [
                    "id" => 151,
                    "name" => "Refugees"
                ],
                [
                    "id" => 109,
                    "name" => "Relationship"
                ],
                [
                    "id" => 12,
                    "name" => "Religious"
                ],
                [
                    "id" => 91,
                    "name" => "Remember"
                ],
                [
                    "id" => 25,
                    "name" => "Respect"
                ],
                [
                    "id" => 100,
                    "name" => "Responsibility"
                ],
                [
                    "id" => 157,
                    "name" => "Revenge"
                ],
                [
                    "id" => 71,
                    "name" => "Revolution"
                ],
                [
                    "id" => 158,
                    "name" => "Rich"
                ],
                [
                    "id" => 26,
                    "name" => "Sad"
                ],
                [
                    "id" => 38,
                    "name" => "Science"
                ],
                [
                    "id" => 118,
                    "name" => "Self-Care"
                ],
                [
                    "id" => 139,
                    "name" => "Shristams"
                ],
                [
                    "id" => 37,
                    "name" => "Smile"
                ],
                [
                    "id" => 153,
                    "name" => "social studies"
                ],
                [
                    "id" => 14,
                    "name" => "Society"
                ],
                [
                    "id" => 36,
                    "name" => "Sports"
                ],
                [
                    "id" => 16,
                    "name" => "Strength"
                ],
                [
                    "id" => 162,
                    "name" => "Stress"
                ],
                [
                    "id" => 15,
                    "name" => "Success"
                ],
                [
                    "id" => 149,
                    "name" => "Sunday"
                ],
                [
                    "id" => 17,
                    "name" => "Teacher"
                ],
                [
                    "id" => 28,
                    "name" => "Technology"
                ],
                [
                    "id" => 88,
                    "name" => "Thinking"
                ],
                [
                    "id" => 44,
                    "name" => "Time"
                ],
                [
                    "id" => 148,
                    "name" => "Today"
                ],
                [
                    "id" => 92,
                    "name" => "Together"
                ],
                [
                    "id" => 135,
                    "name" => "Tomorrow"
                ],
                [
                    "id" => 138,
                    "name" => "Tree"
                ],
                [
                    "id" => 80,
                    "name" => "Truth"
                ],
                [
                    "id" => 146,
                    "name" => "Twyla Tharp"
                ],
                [
                    "id" => 95,
                    "name" => "Unity"
                ],
                [
                    "id" => 126,
                    "name" => "Universe"
                ],
                [
                    "id" => 43,
                    "name" => "Valentine's Day"
                ],
                [
                    "id" => 94,
                    "name" => "Victory"
                ],
                [
                    "id" => 85,
                    "name" => "Vision"
                ],
                [
                    "id" => 152,
                    "name" => "volunteer"
                ],
                [
                    "id" => 57,
                    "name" => "War"
                ],
                [
                    "id" => 134,
                    "name" => "Weakness"
                ],
                [
                    "id" => 144,
                    "name" => "Websites"
                ],
                [
                    "id" => 32,
                    "name" => "Wedding"
                ],
                [
                    "id" => 164,
                    "name" => "Winning"
                ],
                [
                    "id" => 90,
                    "name" => "Wisdom"
                ],
                [
                    "id" => 177,
                    "name" => "Work"
                ],
                [
                    "id" => 123,
                    "name" => "Work-Hard"
                ],
                [
                    "id" => 60,
                    "name" => "Yourself"
                ]
            ]

    );
    }
}
