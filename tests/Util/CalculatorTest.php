<?php
// tests/Util/CalculatorTest.php
namespace App\Tests\Util;

use App\Util\Calculator;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
    
    public function testModif(EntityManagerInterface $entityManager=null)
    {
        $calculator = new Calculator();
        $result = $calculator->modif(30, 12, $entityManager);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(18, $result);
    }
}
