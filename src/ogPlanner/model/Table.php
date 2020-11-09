<?php

namespace ogPlanner\model;


class Table implements ITable
{
    protected array $columnNames;
    protected array $rowData;   // Row based

    /**
     * Table constructor.
     * @param array $rowData
     * @param array $columnNames
     */
    public function __construct(array $columnNames, array $rowData = [])
    {
        $this->columnNames = $columnNames;
        $this->rowData = $rowData;
    }

    /**
     * @param array $rows
     */
    public function addRows(array $rows): void
    {
        foreach ($rows as $row) {
            $this->rowData[] = $row;
        }
    }

    public function getRows(string $key, string $value): array
    {
        $index = array_search($key, $this->columnNames);
        if ($index === false) {
            throw new TableException('Unknown key given');
        }

        $rows = [];
        for ($i = 0; $i < count($this->rowData); $i++) {
            if ($this->rowData[$i][$index] == $value) {
                $rows[] = $this->rowData[$i];
            }
        }

        return $rows;
    }

    /**
     * @return array
     */
    public function getColumnNames(): array
    {
        return $this->columnNames;
    }

    /**
     * @return array|array[]
     */
    public function getAllRows(): array
    {
        return $this->rowData;
    }

    public function getRowCount(): int
    {
        return count($this->rowData);
    }

    public function isEmpty(): bool
    {
        return $this->getRowCount() == 0;
    }

    public function __toString(): string
    {
        $rep = '';

        foreach ($this->columnNames as $columnName) {
            $rep .= $columnName . '        ';
        }

        $rep .= '\n';

        return $rep;
    }
}