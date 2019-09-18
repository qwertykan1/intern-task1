<?php
/*
- Слова находятся по пробелам, но если между словами несколько пробелов, то за слово может приняться пустая строка. Для избежание этого был введен счетчик слов. Если вместо слова получен пробел, то счетчик увеличивается.  Так же были приняты меры по устранению пробелов из ссылки и между тестом и многоточием.
*/
include_once('article.php');

$link = "show-article.php";
$a = substr($a, 0, 180);

$countWords = 2;
$article = $a;
$endArticle= "";//часть статьи, которая должна стать ссылкой

while(true)
{
	/*если нет пробела или два слова отсчитаны,
	то выходим из цикла*/
	$lastSpaceIndex = strrpos($article, ' ');
	if(!($lastSpaceIndex&&$countWords))
	{
		//если в статье мешьне двух слов, то ссылкой становить вся статья
		if($countWords > 0)
			$endArticle = $a;

		$endArticle = trim($endArticle); 
		break;
	}

	$lastWord = substr($article, $lastSpaceIndex);
	$article = substr($article, 0, $lastSpaceIndex);
	//если последнее слово пробел, то делаем еще одну итерацию
	if($lastWord != " ")
	{
		$countWords--;
	}
	
	$endArticle = $lastWord.$endArticle;
}

$endArticle.='...';
$article = $article.' ';
echo "$article<a href='$link'>$endArticle</a>";