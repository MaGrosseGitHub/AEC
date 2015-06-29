var login_txt=false;

function dologin()
{
	var permanent=false;

	if ((document.getElementById('login_email').value == '') || (document.getElementById('login_email').value == l[195]))
	{
		alert(l[197]);	
	}
	else if (checkMail(document.getElementById('login_email').value))
	{
		alert(l[198]);	
	}
	else if ((document.getElementById('login_password').value == '') || (document.getElementById('login_password').value == 'Password'))
	{
		alert(l[199]);	
	}
	else
	{
		document.getElementById('overlay').style.display='';
		
		if (confirmok)
		{
			if (u_signupenck)
			{
				if (checksignuppw(document.getElementById('login_password').value))
				{
					var ctx = 
					{
						callback: function(res,ctx)
						{
							if (typeof res[0] == 'string')
							{
								if (u_type)
								{
									document.getElementById('overlay').style.display='none';
									document.location.hash = 'fm';							
									document.title = 'Mega';
								}
								else postlogin();
							}
							else
							{
								alert(l[200]);
							}
						}
					}										
					if (d) console.log('u_handle');
					if (d) console.log(u_handle);					
					var passwordaes = new sjcl.cipher.aes(prepare_key_pw(document.getElementById('login_password').value));					
					api_updateuser(ctx,
					{
						uh : stringhash(document.getElementById('login_email').value.toLowerCase(),passwordaes),
						c: confirmcode					
					})
				}
				else
				{	
					alert('bad password');		
					document.getElementById('overlay').style.display='none';					
					document.getElementById('login_password').value ='';				
				}
			}
		}
		else
		{
			postlogin();
		}
	}
}


function init_login()
{
	if (login_txt)
	{
		document.getElementById('login_div_topmsg').style.display='';
		document.getElementById('login_topmsg').innerHTML= '<h1>' + login_txt + '</h1>';		
		login_txt=false;	
	}	
}


function postlogin()
{
	var ctx = 
	{
		checkloginresult: function(ctx,r)
		{
			document.getElementById('overlay').style.display='none';
			if (r)
			{
				u_type = r;
				if (page == 'login')
				{					
					document.location.hash = 'fm';
					document.title = 'Mega';
				}
				else init_page();
				if (d) console.log('logged in');					
			}
			else
			{
				document.getElementById('login_password').value='';
				alert(l[201]);
			}
		}	
	}	
	var passwordaes = new sjcl.cipher.aes(prepare_key_pw(document.getElementById('login_password').value));										
	var uh = stringhash(document.getElementById('login_email').value.toLowerCase(),passwordaes);	
	u_login(ctx,document.getElementById('login_email').value,document.getElementById('login_password').value,uh,document.getElementById('login_remember').checked);
}