<?php


namespace App\Object;
use JMS\Serializer\Annotation as JMS;

class TranslatableText
{
    /**
     * @JMS\Type("string")
     * @JMS\Groups({"tr","all"})
     * @var string
     * @JMS\Accessor(getter="getTr")
     */
    private $tr;
    /**
     * @JMS\Type("string")
     * @var string
     * @JMS\Accessor(getter="getEn")
     */
    private $en;


    /**
     * TranslatableText constructor.
     */
    public function __construct($data=[])
    {
        if(!is_array($data) && !is_object($data)) return;
        foreach ($data as $index => $value)
        {
            if(property_exists($this,$index))
            $this->{"set".ucfirst($index)}($value);
        }
    }


    /**
     * @return string
     */
    public function getTr()
    {
        return $this->tr;
    }

    /**
     * @param string $tr
     */
    public function setTr($tr)
    {
        $this->tr = $tr;
    }

    /**
     * @return string
     */
    public function getEn()
    {
        return $this->en ?? $this->tr;
    }

    /**
     * @param string $en
     */
    public function setEn($en)
    {
        $this->en = $en;
    }
}