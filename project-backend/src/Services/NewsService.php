<?php

namespace App\Services;

use App\Api\newsApi;
use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;

class NewsService
{
    public function __construct
    (
        private EntityManagerInterface $em,
        private News $news,
        private newsApi $newsApi
    ) {

    }

    public function getDataNews()
    {
        $dataApi = $this->em->getRepository(News::class)->findAll();
        $dataReturn = [];

        foreach ($dataApi as $newsData) {
            $dataReturn[] = array
            (
                "Title" => $newsData->getTitle(),
                "URL" => $newsData->getUrl(),
                "TimePublished" => $newsData->getTimePublished(),
                "Authors" => $newsData->getAuthors(),
                "Summary" => $newsData->getSummary(),
                "BannerImage" => $newsData->getBannerImage(),
                "Topics" => $newsData->getTopics()
            );
        }

        // $this->saveNewsDataToDb($dataReturn);
        return $dataReturn;
    }

    public function saveNewsDataToDb(array $newsData): array
    {
        foreach ($newsData as $dataSaveDb) {
            $uniqueValue = $this->em->getRepository(News::class)->findOneBy(["title" => $dataSaveDb["Title"]]);

            if (!$uniqueValue) {
                $this->news = new News();
                $this->news->setTitle($dataSaveDb["Title"]);
                $this->news->setUrl($dataSaveDb["URL"]);
                $this->news->setAuthors($dataSaveDb["Authors"]);
                $this->news->setSummary($dataSaveDb["Summary"]);
                $this->news->setBannerImage($dataSaveDb["BannerImage"]);
                $this->news->setTopics($dataSaveDb["Topics"]);

                $this->em->persist($this->news);
            }
        }

        $this->em->flush();

        return $newsData;
    }
}