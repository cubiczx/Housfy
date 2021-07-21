<?php


namespace App\Domain\Model;


final class Mars
{
    const XSURFACE = 200;
    const YSURFACE = 200;
    const OBSTACLES = (self::XSURFACE/2 * self::YSURFACE/2);

    /**
     * @var array $surface
     */
    private $surface;

    /**
     * @var int $addedObstacles
     */
    private $addedObstacles;

    public function __construct(){
        $this->addedObstacles = 0;
        $this->mapMars();
    }

    /**
     * Map mars surface to add random obstacles
     */
    private function mapMars(): void
    {
        for ($x = 0; $x < self::XSURFACE; $x++) {
            for ($y = 0; $y < self::YSURFACE; $y++) {
                // Add obstacle to Mars matrix
                $this->surface[$x][$y] = $this->addObstacle();
            }
        }
    }

    /**
     * Add random obstacles to mars surface
     * @return int
     */
    private function addObstacle(): int
    {
        if($this->addedObstacles < self::OBSTACLES){
            $haveObstacle = rand(0, 1);
            if($haveObstacle){
                $this->addedObstacles ++;
            }
            return $haveObstacle;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getSurface(): array
    {
        return $this->surface;
    }

    /**
     * Find obstacle in mars surface
     *
     * @param int $xAxis
     * @param int $yAxis
     * @return bool
     */
    public function haveObstacle(int $xAxis, int $yAxis): bool
    {
        return $this->surface[$xAxis][$yAxis];
    }

    /**
     * Check Mars surface boundaries
     *
     * @param int $xAxis
     * @param int $yAxis
     * @return bool
     */
    public function checkBoundaries(int $xAxis, int $yAxis): bool
    {
        if($xAxis < self::XSURFACE && $yAxis < self::YSURFACE){
            return true;
        }
        return false;
    }
}