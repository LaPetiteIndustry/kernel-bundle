<?php
namespace Lpi\KernelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Lpi\Kernel\Utils\Text;
use Lpi\KernelBundle\Entity\Behaviour\Timestampable;
use Lpi\NewsBundle\Model\ZoneHasNewsInterface;

abstract class BaseZone
{
    use Timestampable;

    protected $name;
    protected $slug;
    protected $enabled = true;
    protected $zoneHasNews;

    public function __construct()
    {
        $this->zoneHasNews = new ArrayCollection;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = Text::slugify($slug);
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return ArrayCollection
     */
    public function getZoneHasNews()
    {
        return $this->zoneHasNews;
    }


    /**
     * {@inheritdoc}
     */
    public function setZoneHasNews($zoneHasNews)
    {
        $this->zoneHasNews = new ArrayCollection();

        foreach ($zoneHasNews as $zah) {
            $this->addZoneHasNews($zah);
        }
    }

    public function addZoneHasNews(ZoneHasNewsInterface $zoneHasNews)
    {
        $zoneHasNews->setZone($this);
        $this->zoneHasNews[] = $zoneHasNews;
    }

    public function __toString()
    {
        return $this->getName() . ' (' . $this->getSlug() . ')';
    }
}