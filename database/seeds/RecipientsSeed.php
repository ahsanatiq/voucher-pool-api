<?php
namespace database;

use Phinx\Seed\AbstractSeed;

class RecipientsSeed extends AbstractSeed
{
    public function run()
    {
        $faker = \Faker\Factory::create('en_US');
        $data  = [];
        $data[] = [
            'name'  => 'Test User',
            'email' => 'test@test.com',
        ];
        foreach (range(1, 29) as $index) {
            $data[] = [
                'name'  => $faker->name,
                'email' => $faker->email,
            ];
        }

        $this->insert('recipients', $data);
    }
}
