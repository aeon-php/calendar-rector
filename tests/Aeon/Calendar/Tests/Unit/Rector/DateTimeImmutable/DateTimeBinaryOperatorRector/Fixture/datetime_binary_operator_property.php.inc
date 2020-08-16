<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class DateTimeProperties
{
    private \DateTimeImmutable $left;

    /**
     * @var \DateTimeInterface
     */
    private $right;

    public function __construct()
    {
        $this->left = new \DateTimeImmutable('-1 day');
        $this->right = new \DateTime('+1 day');
    }

    public function test()
    {
        if ($this->left < $this->right) {
            $result = 'before';
        }

        if ($this->left > $this->right) {
            $result = 'after';
        }

        if ($this->left <= $this->right) {
            $result = 'before or equal';
        }

        if ($this->left >= $this->right) {
            $result = 'after or equal';
        }

        if ($this->left == $this->right) {
            $result = 'equal';
        }
    }
}

?>
-----
<?php

namespace Aeon\Calendar\Tests\Unit\Rector\DateTimeImmutable\DateTimeBinaryOperatorRector\Fixture;

class DateTimeProperties
{
    private \DateTimeImmutable $left;

    /**
     * @var \DateTimeInterface
     */
    private $right;

    public function __construct()
    {
        $this->left = new \DateTimeImmutable('-1 day');
        $this->right = new \DateTime('+1 day');
    }

    public function test()
    {
        if ($this->left->isBefore($this->right)) {
            $result = 'before';
        }

        if ($this->left->isAfter($this->right)) {
            $result = 'after';
        }

        if ($this->left->isBeforeOrEqual($this->right)) {
            $result = 'before or equal';
        }

        if ($this->left->isAfterOrEqual($this->right)) {
            $result = 'after or equal';
        }

        if ($this->left->isEqual($this->right)) {
            $result = 'equal';
        }
    }
}

?>