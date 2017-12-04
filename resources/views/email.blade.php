<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Fonovitta - Fonoaudiologia de Excelência</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body style="margin: 0; padding: 0;">
		
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
			<tr>
				<td align="left" bgcolor="#f0f4f5" style="padding: 20px; color:#444; font-family: 'Open Sans',sans-serif; font-size: 20px; line-height:50px">
					<b>FONOVITTA</b> <small>Fonoaudiologia de Excelência</small>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#f0f4f5" style="padding: 30px 0 70px 0; color:#444; font-family: 'Open Sans',sans-serif; font-size: 43px; line-height:50px">
					{{ $titulo }}
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="padding-bottom:10px; font-family: 'Open Sans',sans-serif; font-size: 16px; line-height:24px">
								<b>{{ $nome }}</b> <small> {{ $email }} </small>
					  		</td>
						</tr>
					 	<tr>
					  		<td style="font-family: 'Open Sans',sans-serif; font-size: 13px; line-height:20px">
					   			{!! nl2br(e($mensagem)) !!}
					  		</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#2b2b2b" style="padding: 10px 10px 10px 10px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td bgcolor="#2b2b2b" width="50%" style="padding-top:20px!important; padding:5px; text-align:center; color:#888; font-family: 'Open Sans',sans-serif; font-size: 13px; line-height:20px">
								<h3 style="color:#fff; font-size: 16px">Fonovitta</h3>
								<hr style="border:0; height:1px; width:50%; background: #555;">
								Fonovitta é um serviço de fonoaudiologia focado no tratamento de distúrbios da deglutição causado pelas mais diversas doenças, como Parkinson, Alzheimer, Câncer e outros.
							</td>
							<td bgcolor="#2b2b2b" width="50%" style="padding-top:20px!important; padding:5px; text-align:center; color:#888; font-family: 'Open Sans',sans-serif; font-size: 13px; line-height:20px">
								<h3 style="color:#fff; font-size: 16px">Endereço</h3>
								<hr style="border:0; height:1px; width:50%; background: #555;">
								Rua Dr. Emílio Ribas, 1.058 - Cambuí <br>
								Campinas - SP  <br>
								13025-142  <br>
								Telefone: (19) 3294-1470  <br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#2b2b2b" style="padding-bottom:15px; text-align:center; color:#888; font-family: 'Open Sans',sans-serif; font-size: 12px; line-height: 24px;">
					2014 &copy; Todos direitos reservados.
				</td>
			</tr>
		</table>

	</body>
</html>