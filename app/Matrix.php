<?php


class Matrix
{
    protected $matrix;
    protected $countRows;
    protected $countCols;

    public function __construct(array $arr = [])
    {
        $this->setMatrix($arr);
    }

    function setMatrix(array $arr){
        if(!$arr)
            return;

        $this->matrix = $this->toMatrix($arr);
        $size = $this->getMinSize($this->matrix);
        $this->countRows = $size['minRows'];
        $this->countCols = $size['minCols'];
    }

    private function toMatrix(array $arr){
        $tmp = [];
        $size = $this->getMinSize($arr);
        for ($i = 0; $i < $size['minRows']; $i++){
            for ($j = 0; $j < $size['minCols']; $j++){
                $tmp[$i][$j] = $arr[$i][$j];
            }
        }
        return $tmp;
    }

    private function getMinSize(array $arr){
        if (!$arr)
            return 0;
        $size['minCols'] = count($arr[0]);
        $size['minRows'] = count($arr);

        for ($i = 0; $i < count($arr); $i++){
            if($size['minCols'] > count($arr[$i])){
                $size['minCols'] = count($arr[$i]);
                $size['minRows'] = $i + 1;
            }
        }
        return $size;
    }

    function toArray(){
        return $this->matrix;
    }

    function getCountRows(){
        return $this->countRows;
    }

    function getCountCols(){
        return $this->countCols;
    }

    function add(Matrix $matrix) : Matrix{
        if(($this->compareTo($matrix) <= 0 && !$this->isSquareMatrix()) || ($this->isSquareMatrix() && !$this->compareTo($matrix)))
            return new Matrix();

        $tmp = [];

        for ($row = 0; $row < $this->getCountRows(); $row++){
            for ($col = 0; $col < $this->getCountCols(); $col++){
                $tmp[$row][$col] = $this->matrix[$row][$col] + $matrix->matrix[$row][$col];
            }
        }
        return new Matrix($tmp);
    }

    function diff(Matrix $matrix) : Matrix{
        $tmp = [];
        if(($this->compareTo($matrix) <= 0 && !$this->isSquareMatrix()) || ($this->isSquareMatrix() && !$this->compareTo($matrix)))
            return new Matrix();

        for ($row = 0; $row < $this->getCountRows(); $row++){
            for ($col = 0; $col < $this->getCountCols(); $col++){
                $tmp[$row][$col] = $this->matrix[$row][$col] - $matrix->matrix[$row][$col];
            }
        }

        return new Matrix($tmp);
    }

    function mult(Matrix $matrix) : Matrix{
        $tmp = [];
        if(($this->compareTo($matrix) >= 0 && !$this->isSquareMatrix()) || ($this->isSquareMatrix() && !$this->compareTo($matrix)))
            return new Matrix();

        for ($i = 0; $i < $this->getCountRows(); $i++){
            for($j = 0; $j < $matrix->getCountCols(); $j++){
                $tmp[$i][$j] = 0;
                for($k = 0; $k < $matrix->getCountRows(); $k++){
                    $tmp[$i][$j] += $this->matrix[$i][$k]*$matrix->matrix[$k][$j];
                }
            }
        }
        return new Matrix($tmp);
    }

    /**
     * @param Matrix $matrix
     * @return int
     *
     * Сравнение матрицы с другой матрицей по кол-ву записей
     *  0 - Размер матриц разные
     *  1 - Размер матрицы полностью идентична
     * -1 - Размер матриц ассиметричен
     */
    function compareTo(Matrix $matrix){
        if($this->isSquareMatrix() && !$matrix->isSquareMatrix())
            return 0;

        if($this->countRows == $matrix->countRows && $this->countCols == $matrix->countCols)
            return 1;
        else if($this->countRows == $matrix->countCols && $this->countCols == $matrix->countRows)
            return -1;
        return 0;
    }

    function isSquareMatrix(){
        return $this->getCountCols() == $this->getCountRows();
    }

    function fillRandom(int $countRows = 2, int $countCols = 2){
        if($countRows <= 0 || $countCols <= 0)
            return;

        $tmp = [];

        for ($i = 0; $i < $countRows; $i++){
            for ($j = 0; $j < $countCols; $j++){
                $tmp[$i][$j] = mt_rand(0, 10);
            }
        }

        $this->setMatrix($tmp);
    }

    public function __toString() : string
    {
        $str = "";
        for ($i = 0; $i < $this->countRows; $i++){
            for ($j = 0; $j < $this->countCols; $j++){
                $str .= $this->matrix[$i][$j] . (($j < $this->countCols - 1) ? " " : "\r\n");
            }
        }
        return $str;
    }
}
