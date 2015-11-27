# KendoLab Platform
Open Social Network Script based on LAMP

This repository is used to manage issues and source code and may be **Private** without any announcement.

## System Requirements
1. **PHP 5.4+**
2. **MySQL 5.0+** with **InnoDB** Support

## Installation

1. Download latest release version from http://kendolab.com/download-latest
2. Extract to your web directory
3. Access "/install" to from browser then follow installation winzard to complete.



## Modify repository

Leafo/Compiler::importFile

```
$pi = pathinfo($path);
array_push($this->importPaths, $pi['dirname']);
$this->compileChildren($tree->children, $out);
array_pop($this->importPaths);
```