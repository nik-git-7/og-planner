<?php

namespace ogPlanner\model;

require_once 'ITable.php';

use ogPlanner\controller\TableException;

class Table implements ITable
{
    protected array $columnNames;
    protected array $rowData;   // Row based

    /**
     * Table constructor.
     * @param array $rowData
     * @param array $columnNames
     */
    public function __construct(array $columnNames, array $rowData = array([]))
    {
        $this->columnNames = $columnNames;
        $this->rowData = $rowData;
    }

    /**
     * @param array $rows
     */
    public function addRows(array $rows): void
    {
        $this->rowData[] = $rows;
    }

    public function getRows(string $key, string $value): array
    {
        if (!array_search($key, $this->columnNames)) {
            throw new TableException('Unknown key given');
        }

        $rows = array([]);
        for ($i = 0; $i < count($this->rowData); $i++) {
            if ($this->rowData[$i][$key] == $value) {
                $rows[] = $this->rowData[$i][$key];
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

    public function __toString(): string
    {
        $rep = '';

        foreach ($this->columnNames as $columnName) {
            $rep .= $columnName . '        ';
        }

        $rep .= '\n';

        return $rep;
    }

    public function getRowCount(): int
    {
        return count($this->rowData);
    }

    public function isEmpty(): bool
    {
        return $this->getRowCount() == 0;
    }
}