<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jayParsedAry = [
            [
                "id" => 602,
                "content" => "“Football is about joy. It’s about dribbling. I favor every idea that makes the game beautiful. Every good idea has to last.”",
                "author" => "Ronaldinho"
            ],
            [
                "id" => 601,
                "content" => "“The secret is to believe in your dreams; in your potential that you can be like your star, keep searching, keep believing, and don’t lose faith in yourself.”",
                "author" => "Neymar"
            ],
            [
                "id" => 600,
                "content" => "“I want to win and always have done since I was small. I don’t know if it’s in my blood or just my personality.”",
                "author" => "Diego Costa"
            ],
            [
                "id" => 599,
                "content" => "“I only think about the pitch. I want to do great. I want to be one of the best. I want to win titles. I want to achieve things.”",
                "author" => "Paul Pogba"
            ],
            [
                "id" => 598,
                "content" => "“Your love makes me strong, your hate makes me unstoppable!”",
                "author" => "Cristiano Ronaldo"
            ],
            [
                "id" => 597,
                "content" => "“Success is no accident. It is hard work, perseverance, learning, studying, sacrifice, and most of all, love of what you are doing or learning to do.”",
                "author" => "Pele"
            ],
            [
                "id" => 596,
                "content" => "I firmly believe that any man's finest hour, the greatest fulfillment of all that he holds dear, is that moment when he has worked his heart out in a good cause and lies exhausted on the field of battle - victorious.",
                "author" => "Vince Lombardi"
            ],
            [
                "id" => 595,
                "content" => "To accomplish great things, we must not only act, but also dream; not only plan, but also believe.",
                "author" => "Anatole France"
            ],
            [
                "id" => 594,
                "content" => "Believe you can and you're halfway there.",
                "author" => "Theodore Roosevelt"
            ],
            [
                "id" => 593,
                "content" => "If you believe in yourself and have dedication and pride - and never quit, you'll be a winner. The price of victory is high but so are the rewards.",
                "author" => "Bear Bryant"
            ],
            [
                "id" => 592,
                "content" => "The future belongs to those who believe in the beauty of their dreams.",
                "author" => "Eleanor Roosevelt"
            ],
            [
                "id" => 591,
                "content" => "When someone shows you who they are, believe them the first time.",
                "author" => "Maya Angelou"
            ],
            [
                "id" => 590,
                "content" => "I believe that you should gravitate to people who are doing productive and positive things with their lives.",
                "author" => "Nadia Comaneci"
            ],
            [
                "id" => 589,
                "content" => "I'm taking all the negatives in my life, and turning them into a positive.",
                "author" => "Pitbull"
            ],
            [
                "id" => 588,
                "content" => "I'm looking forward to influencing others in a positive way. My message is you can do anything if you just put your mind to it.",
                "author" => "Justin Bieber"
            ]
        ];



        foreach ($jayParsedAry as $note){


            $n = new Note();
            $n->description = $note['content'];


            $raw = Author::where('name',$note['author']);
            if (!$raw->exists()){
                $author = new Author();
                $author->name = $note['author'];
                $author->save();

                $n->author_id = $author->id;

            }else{
                $n->author_id = $raw->first()->id;
            }


            $n->is_poem = random_int(0,1);
            $n->save();
        }
    }
}
