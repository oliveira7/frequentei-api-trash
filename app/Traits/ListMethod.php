<?php

namespace App\Traits;

trait ListMethod
{
    /**
     * Default per page.
     */
    private static int $DEFAULT_PER_PAGE = 15;

    /**
     * Maximum per page.
     */
    private static int $MAX_PER_PAGE = 50;

    /**
     * Generic searchable columns.
     */
    private array $genericSearchableColumns = [];

    /**
     * Individual searchable columns.
     */
    private array $individualSearchableColumns = [];

    /**
     * Sortable columns.
     */
    private array $sortableColumns = [];

    /**
     * Can disable pagination.
     */
    private bool $canDisablePagination = false;

    public function setGenericSearchableColumns(array $genericSearchableColumns): void
    {
        $this->genericSearchableColumns = $genericSearchableColumns;
    }

    public function setIndividualSearchableColumns(array $individualSearchableColumns): void
    {
        $this->individualSearchableColumns = $individualSearchableColumns;
    }

    public function setSortableColumns(array $sortableColumns): void
    {
        $this->sortableColumns = $sortableColumns;
    }

    public function setCanDisablePagination(bool $canDisablePagination): void
    {
        $this->canDisablePagination = $canDisablePagination;
    }
}
