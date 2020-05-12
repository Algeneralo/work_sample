@if ($sortField !== $field)
    <i class="fas fa-sort text-primary"></i>
@elseif ($sortAsc)
    <i class="fas fa-sort-amount-up-alt text-primary"></i>
@else
    <i class="fas fa-sort-amount-down-alt text-primary"></i>
@endif