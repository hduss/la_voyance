<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Prestations;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminEventSubscriber implements EventSubscriberInterface
{


    public function __construct()
    {
        $this->dateNow = new \DateTime('now');
    }


    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBlogPost'],
            BeforeEntityUpdatedEvent::class => ['updateBlogPost']
        ];
    }

    /**
     * @param BeforeEntityPersistedEvent $event
     * @return void
     */
    public function setBlogPost(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof BlogPost) {
            $entity->setCreatedDate($this->dateNow);
            $entity->setUpdatedDate($this->dateNow);
        }elseif($entity instanceof Prestations){
            $entity->setCreatedAt($this->dateNow);
            $entity->setUpdatedAt($this->dateNow);
//            var_dump($this->dateNow->format('H:i:s'));
//            die('test time');
//            $entity->setDuringTime($this->dateNow->format('H:i:s'));
        }
    }

    /**
     * @param BeforeEntityUpdatedEvent $event
     * @return void
     */
    public function updateBlogPost(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof BlogPost)) {
            return;
        }
        $entity->setUpdatedDate($this->dateNow);
    }

    public function setPrestations(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Pestations)) {
            return;
        }

    }
}