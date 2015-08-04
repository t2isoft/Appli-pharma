$(document).ready(function()
{

	$('#search').keyup(function()
	{

			var search = $(this).val();
			search= $.trim(search);//trim vire les espaces du debut
			
			if(search !=="")
			{
					$('#loader').show();
					$.post('post2.php',{search:search},function(data)
					{
						
						$('#resultat ul').html(data).show();
						$('#feedback').hide();
						
						$('#loader').hide();

							$('a').click(function()
							{
							
								var lien=$(this);

							$('#loader').show();

							$('#search').attr('value',lien.val());

							$.post('show2.php',{lien:''+ lien.attr('id')+''},function(data){

								$('#feedback').html(data);
								$('#feedback').show();
								$('#loader').hide();
								$('#resultat ul').hide();


							});

							});				
					});

			}

	});
});
/******fin list de recherche********/