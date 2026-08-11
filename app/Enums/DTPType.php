<?php

namespace App\Enums;

enum DTPType: string
{
    case ARTICLES = 'Articles';
    case WHITEPAPERS = 'Whitepapers';
    case RESEARCH = 'Research';
    case REPORTS = 'Reports';
    case JOURNALS = 'Journals';
    case FACTSHEETS = 'Factsheets';
    case Newsletter = 'Newsletter';
    case SHAREHOLDERRIGHTINFORMATION = 'Shareholders rights information';
}
