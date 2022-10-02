<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Project;
use App\Entity\Text;
use App\Entity\Translate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createProjectsWithLanguages($this->createLanguages());

        $manager->flush();
    }

    /**
     * @return Language[]
     */
    private function createLanguages(): array
    {
        $languages = [];
        $language = (new Language())->setCode('en')->setTitle('English');
        $this->manager->persist($language);
        $languages[] = $language;

        $language = (new Language())->setCode('uk')->setTitle('Ukrainian');
        $this->manager->persist($language);
        $languages[] = $language;

        $language = (new Language())->setCode('cz')->setTitle('Czech');
        $this->manager->persist($language);
        $languages[] = $language;

        return $languages;
    }

    /**
     * @param Language[] $languages
     * @return void
     */
    private function createProjectsWithLanguages(array $languages): void
    {
        $project = (new Project())
            ->setSlug('gothic-1')
            ->setTitle('Gothic 1')
            ->setLanguages(new ArrayCollection($languages));

        $this->manager->persist($project);
        $this->createCategoriesForProject($project, 2);

        $project = (new Project())
            ->setSlug('elder-scrolls-5')
            ->setTitle('Elder scrolls 5')
            ->setLanguages(new ArrayCollection([$languages[0], $languages[2]]));

        $this->manager->persist($project);

        $this->createCategoriesForProject($project, 3);

    }

    private function createCategoriesForProject(Project $project, int $count): void
    {
        $categories = ['SE', 'CE', 'Mini games'];

        for ($i = 0; $i < $count; $i++) {
            $category = (new Category())
                ->setTitle($categories[$i] ?? "Category{$i}")
                ->setProject($project);

            $this->manager->persist($category);

            $this->createSubcategoriesForCategory($category, $i + $i * 3);
            $this->createTextsForCategory($category, $i + $i * rand(1, 9));
        }
    }

    private function createSubcategoriesForCategory(Category $category, int $count): void
    {
        $prefix = $category->getTitle() === 'Mini games' ? 'MG_' : 'Back_';

        for ($i = 0; $i < $count; $i++) {
            $subCategory = (new Category())
                ->setTitle($prefix . ($i + 1))
                ->setProject($category->getProject())
                ->setParentCategory($category);

            $this->manager->persist($subCategory);

            $this->createTextsForCategory($subCategory, $i + $i * 3);
        }
    }

    private function createTextsForCategory(Category $category, int $count): void
    {
        $keyPrefix = 'tt_';
        $items = ['button', 'rope', 'nose', 'totem'];
        $events = ['Push', 'Take', 'Stay on', 'Use'];

        for ($i = 0; $i < $count; $i++) {
            $text = (new Text())
                ->setCategory($category)
                ->setKey($keyPrefix . $i)
                ->setDefaultText(
                    sprintf('%s %s', $events[array_rand($events)], $items[array_rand($items)])
                );

            $this->manager->persist($text);
            $this->createTranslatesForText($text);
        }
    }

    private function createTranslatesForText(Text $text): void
    {
        $languages = $text->getCategory()->getProject()->getLanguages();
        foreach ($languages as $language) {
            $translate = (new Translate())
                ->setText($text)
                ->setLanguage($language)
                ->setTranslate("[{$language->getCode()}] {$text->getDefaultText()}");

            $this->manager->persist($translate);
        }
    }
}
