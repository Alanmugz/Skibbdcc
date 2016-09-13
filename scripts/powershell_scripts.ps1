# To build the powershell script
#	. .\powershell_scripts.ps1
#
# To run the function
#	


#http://stackoverflow.com/questions/3822745/rename-files-to-lowercase-in-powershell

function toLowerCaseAllFilesInDirectory($directory) {
	If ($directory -eq $Null) { Write-error "Pass in the path of the directory you would like to lowercase" }
    dir $directory -r | % { if ($_.Name -cne $_.Name.ToLower()) { ren $_.FullName $_.Name.ToLower() } }
}



