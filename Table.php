<?php


class Table
{
    protected array $headerColumns;
    protected array $rows;

    /**
     * Table constructor.
     * @param array $headerColumns
     * @param array $rows 2-dim array
     */
    public function __construct(array $headerColumns, array $rows)
    {
        $this->headerColumns = $headerColumns;
        $this->rows = $rows;
    }

    public function getColumnByName(string $columnName)
    {

    }

    /**
     * @return array
     */
    public function getHeaderColumns(): array
    {
        return $this->headerColumns;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }


}