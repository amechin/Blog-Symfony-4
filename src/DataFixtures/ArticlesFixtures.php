<?php


namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Service\slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Tag;


class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /*$faker  =  Faker\Factory::create('fr_FR');*/
        $slugify = new slugify();

        /*for($i=0; $i<50; $i++){
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent(mb_strtolower($faker->paragraph));
            $article->setCategory($this->getReference('categorie_'. rand(0, 4)));
            $article->setSlug($slugify->generate($faker->sentence(2)));
            $manager->persist($article);
        }
        $manager->flush();*/

        for ($i = 1; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);

            $tag = new Tag();
            $tag->setName("tag " . $i);
            $manager->persist($tag);

            $article = new Article();
            $article->setTitle("article " . $i);
            $article->setSlug($slugify->generate($article->getTitle()));
            $article->setContent("article " . $i . " content");
            $article->setCategory($category);
            $article->addTag($tag);
            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

}