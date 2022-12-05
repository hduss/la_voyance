<?php

# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BlogPostSubscriber implements EventSubscriberInterface
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
        if (!($entity instanceof BlogPost)) {
            return;
        }
        $entity->setCreatedDate($this->dateNow);
        $entity->setUpdatedDate($this->dateNow);
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
}