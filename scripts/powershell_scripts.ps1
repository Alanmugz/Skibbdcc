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


function addNewYearFolderToDirectory($year) {
	If ($year -eq $Null) 
	{ 
		Write-error "Pass in the year of the directory you wish to add to the events file folders"
	}
	else 
	{
		$directories = @(
		"100_isles_night_nav",
		"autocross",
		"autotest_august",
		"autotest_may",
		"carbery_night_nav",
		"club_championship",
		"loose_surface_autocross_february",
		"loose_surface_autocross_july")
		
		$directories | foreach {
			New-Item -ItemType directory -Path "..\files\$_\$year"
		}
	}
}






