#Region  Project Attributes 
	#ApplicationLabel: B4A Example
	#VersionCode: 1
	#VersionName: 
	'SupportedOrientations possible values: unspecified, landscape or portrait.
	#SupportedOrientations: unspecified
	#CanInstallToExternalStorage: False
#End Region

#Region  Activity Attributes 
	#FullScreen: False
	#IncludeTitle: True
#End Region

Sub Process_Globals
	'These global variables will be declared once when the application starts.
	'These variables can be accessed from all modules.
	
End Sub

Sub Globals
	'These global variables will be redeclared each time the activity is created.
	'These variables can only be accessed from this module.
	Private edtStudentNo As EditText
	Private edtPassword As EditText
End Sub

Sub Activity_Create(FirstTime As Boolean)
	'Do not forget to load the layout file created with the visual designer. For example:
	Activity.LoadLayout("Login_Layout")
	JSON_Users
End Sub

Sub JSON_Users
	Dim jsonUsers As HttpJob
	jsonUsers.Initialize("users", Me)
	jsonUsers.Download("http://192.168.1.103/dhvtsu/student-app/api/users.php")
End Sub


Sub JobDone (Job As HttpJob)
	
   Log("JobName = " & Job.JobName & ", Success = " & Job.Success)
   If Job.Success = True Then
   		Dim res As String
		'get json response
   		res = Job.GetString
		Dim parser As JSONParser
		parser.Initialize(res)
		Log(res)
		
		Select Job.JobName
		
		 Case "users"
			Dim response As Map
			'parse json response
			response = parser.NextObject
			
			Dim status As String
			'get status value
			status = response.Get("status")

			If status = "ok" Then
				Dim persons As List
				'get array values
				persons = response.Get("users")
				'Log(persons)
				'log(persons.Size)
				For i = 0 To persons.Size - 1
					Dim person As Map
					'assign array value each loop
					person = persons.Get(i)
					'Log(person)
					'diplay value
					Log(person.Get("user_id"))
					Log(person.Get("first_name"))
					Log(person.Get("middle_name"))
					Log(person.Get("last_name"))
				Next
			End If
			
		End Select
   Else
      Log("Error: " & Job.ErrorMessage)
      ToastMessageShow("Error: " & Job.ErrorMessage, True)
   End If
   Job.Release
End Sub

Sub Activity_Resume

End Sub

Sub Activity_Pause (UserClosed As Boolean)

End Sub
Sub btnLogin_Click
	'StartActivity("Main_Menu_Activity")
	JSON_Users
End Sub