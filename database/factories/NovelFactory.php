<?php

namespace Database\Factories;

use App\Models\Novel;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Bluemmb\Faker\PicsumPhotosProvider;

class NovelFactory extends Factory
{
    protected $model = Novel::class;

    

    public function definition()
    {
        $titles = [
            'Heros of the Storm',
            'The Last of Us',
            'The Legend of Zelda',
            'The Legend of Zelda: Breath of the Wild',
            'The Legend of Zelda: Ocarina of Time',
            'The Legend of Zelda: Skyward Sword',
            'Rankers of the Wild',
            'Reincarnated as a Slime',
            'Reincarnated as Sword Art Online',
            'Missile Command',
            'Turning Point',
            'The lord of rick and morty',
            'Love, Death, and Robots',
            'The Love Game',
            'Magic Bullet',
            'Magic Emperor',
            'Heaven\'s Gate',
            'The Last Wish',
            'Solo Leveling',
            'The Hunter',
            'Nano Machine',
            'The Legend of Zelda: Majora\'s Mask',
        ];
    
        $descriptions = [
            'A thrilling adventure of a young hero.',
            'A suspenseful mystery novel.',
            'Explore the mystical realms of fantasy.',
            'A heartwarming tale of love and devotion.',
            'Journey through time and space with futuristic tales.',
            'Unravel mysteries and face chilling adventures.',
            'Relive the past with tales of historical significance.',
            'Face your deepest fears with horrifying tales.',
            'Embark on epic quests and daring escapades.',
            'Fall in love with romantic tales of passion.',
            'Discover the beauty of love in these heartwarming stories.',
            'Venture into lands of magic and wonder.',
            'Prepare to be terrified in this chilling collection.',
            'Experience events that shaped our world.',
            'Courage and excitement await in this thrilling journey.',
            'Explore alternate realities and technological wonders.',
            'Danger lurks in every corner in this thrilling journey.',
            'Love knows no boundaries in this touching story.',
            'In the dark of night, secrets are unveiled.',
            'A young hero embarks on an unforgettable journey.',
            'Discover the beauty of love in these heartwarming stories.',
            'Experience events that shaped our world.',
        ];
    
        $synopses = [
            'Embark on a thrilling adventure as a young hero navigates through challenges and discovers their true destiny.',
            'Dive into a suspenseful mystery novel where dark secrets unfold under the cover of night.',
            'Join the epic journey through mystical realms filled with magic, dragons, and ancient prophecies.',
            'Follow the heartwarming tale of love and devotion that transcends all obstacles and touches the soul.',
            'Immerse yourself in futuristic tales that explore the boundless possibilities of science and technology.',
            'Uncover chilling mysteries and face terrifying adversaries in a series of spine-tingling adventures.',
            'Relive pivotal moments in history through captivating stories that bring the past to life.',
            'Confront your deepest fears in a collection of horrifying tales that will leave you trembling.',
            'Embark on epic quests and daring escapades across fantastical worlds filled with danger and excitement.',
            'Indulge in romantic tales of passion, heartache, and undying love that will stir the heart.',
            'Discover the power of love in stories that celebrate the beauty and complexity of human emotions.',
            'Enter a world of magic and wonder where anything is possible and heroes are forged in the fires of destiny.',
            'Prepare for a spine-chilling collection of tales that will haunt your dreams and test your courage.',
            'Explore pivotal moments in history that shaped the world we live in today.',
            'Join brave adventurers as they face danger, uncover ancient mysteries, and forge their own legends.',
            'Embark on a journey through alternate realities and technological marvels that push the boundaries of imagination.',
            'Navigate treacherous waters and deadly encounters in a pulse-pounding thriller that will keep you on the edge of your seat.',
            'Experience the transformative power of love in a story that transcends time, space, and the limitations of the human heart.',
            'Uncover dark secrets and hidden truths in the shadows of the night where danger lurks and trust is a rare commodity.',
            'Follow a young hero as they embark on an epic quest filled with challenges, allies, and foes in equal measure.',
            'Journey through fantastical lands, battle fearsome foes, and discover the true meaning of heroism.',
        ];
    
        $userIds = User::pluck('id')->toArray();
        $randomUserId = $this->faker->randomElement($userIds);

        $fakerWithPicsum = $this->withPicsumProvider($this->faker);

        $categoryId = Category::pluck('id')->toArray();
        $randomCategoryId = $this->faker->randomElement($categoryId);

        // Seed menggunakan randomNumber untuk mendapatkan seed yang unik
        $seed = $this->faker->unique()->randomNumber(8);

        $title = $this->faker->randomElement($titles);
        $descriptions = $this->faker->randomElement($descriptions);
        $synopses = $this->faker->randomElement($synopses);

        return [
            'title' => $title,
            'description' => $descriptions,
            'author' => $randomUserId,
            'category_id' => $randomCategoryId,
            'cover_image' => $fakerWithPicsum->imageUrl(800, 600, true, false, $seed),
            'published_date' => $this->faker->date(),
            'synopsis' => $synopses,
        ];
    }

    protected function withPicsumProvider($faker)
    {
        $faker->addProvider(new PicsumPhotosProvider($faker));
        return $faker;
    }
}
