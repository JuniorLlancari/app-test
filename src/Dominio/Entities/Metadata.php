<?php
namespace Src\Dominio\Entities;

class Login
{
    public int $CurrentPage ;
    public int $TotalPages;
    public int $PageSize;
    public int $TotalCount;
    public bool $HasPreviousPage;
    public bool $HasNextPage;
    
    
    public string $NextPageUrl;
    public string $PreviousPageUrl;  
 
}
 