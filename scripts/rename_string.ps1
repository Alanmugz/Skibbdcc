$files = Get-ChildItem -recurse | Select-String -pattern "col-md-12 headerBackgroundColor" | group path | select name 

foreach ($file in $files)
{
    Write-Host $file.Name
    (Get-Content $file.Name).replace('col-md-12 headerBackgroundColor', 'col-md-12 headerBackgroundColor') | Set-Content $file.Name
}

Write-Host "Done"
