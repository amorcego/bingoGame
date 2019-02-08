<?php
	include'funcoes.php';
	verifica('b2');
?>
<html>
    <head>
        <title>Bingo online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="iso-8859-1">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js"></script>
		<script>
			$(document).ready(function(){
				setInterval("jogando()", 1000); 
			});
			function jogando(){
				$.ajax({url:"funcoes.php", type:"post", data: {funcao: "jogando"}, success: function(result){
					$("#msg").html(result);
				}});
			}
		</script>
    </head>
    <body>
		<div id="conteudo">
			<center>
				<div id="historico">
					<div>01 </div><div> 02</div><div>03 </div><div> 04</div><div>05 </div><div> 06</div><div>07 </div><div> 08</div><div>09 </div>
					<div>10 </div><div>11 </div><div> 12</div><div>13 </div><div>14 </div><div> 15</div><div> 16</div><div> 17</div><div>18 </div>
					<div>19 </div><div>20 </div><div> 21</div><div>22 </div><div>23 </div><div> 24</div><div> 25</div><div>26 </div><div> 27</div>
					<div>28 </div><div>29 </div><div>30 </div><div>31 </div><div>32 </div><div> 33</div><div> 34</div><div>35 </div><div>36 </div><div>37 </div>
					<div> 38</div><div>39 </div><div>40 </div><div>41 </div><div>42 </div><div>43 </div><div>44 </div><div>45 </div><div>46 </div>
					<div> 47</div><div>48 </div><div> 49</div><div>50 </div><div>51 </div><div>52 </div><div>53 </div><div>54 </div><div>55 </div>
					<div> 56</div><div>57 </div><div> 58</div><div>59 </div><div>60 </div><div>61 </div><div>62 </div><div>63 </div><div> 64</div>
					<div>65 </div><div>66 </div><div>67 </div><div>68 </div><div>69 </div><div> 70</div><div> 71</div><div>72 </div><div>73 </div><div>74 </div><div>75 </div>
					
				</div>
				<div id="msg"></div>
				<div id="cartela">
					<?php cartela(); ?>
				</div>
				<div id="pause">
					<?php inputAdm(); ?>
				</div>
				<div id="msg1"></div>
			</center>
		</div>
    </body>
</html>