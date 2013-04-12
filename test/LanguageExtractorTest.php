<?php
require_once('models/LanguageCommentExtractor.php');

class LanguageExtractorTest extends PHPUnit_Framework_TestCase
{

    // Fixtures
    private $realComment = <<< 'COMMENT'
--norwegian--
En ordrett oversettelse *<i>была по дороге домой</i> er uheldig her; <i>по дороге</i> kan eventuelt brukes i en upersonlig konstruksjon med kopulaverbet: <i>ей /ему было по дороге с ним /нею</i> med betydningen: <i>в том же направлении, попутно</i>.
<br><br>
Variantene
 <i>
возвращалась домой / шла (по дороге) домой</i> beskriver begge en prosess i imperfektivt aspekt, en prosess som danner bakgrunn for den videre historien.
<br><br>
--russian--
Дословный перевод *<i>была по дороге домой</i> невозможен в силу лексической сочетаемости выражения по дороге с безличным оборотом <i>ей /ему было по дороге с ним /нею</i> в значении <i>в том же направлении, попутно</i>.
<br><br>
Варианты перевода <i>возвращалась домой / шла (по дороге) домой </i> оба сообщают о действии как о процессе в несовершенном виде, на фоне которого будут развиваться другие события. Оба переводчика применили конкретизирующие глаголы (способ конкретизации). Сравни: при переводе с английского языка слово <i>man</i> может быть переведено на русский язык многими конкретными лексическими единицами, в зависимости от того, о ком идет речь: человек, рядовой, мужчина. Противоположный способ – генерализация, т.е. вместо точного и не всегда понятного иноязычному читателю слова переводчик вправе его заменить на родовое наименование, например: сватья – родственница.
COMMENT;

    private $norwegian_comment = <<< 'NORWEGIAN_COMMENT'
En ordrett oversettelse *<i>была по дороге домой</i> er uheldig her; <i>по дороге</i> kan eventuelt brukes i en upersonlig konstruksjon med kopulaverbet: <i>ей /ему было по дороге с ним /нею</i> med betydningen: <i>в том же направлении, попутно</i>. <br><br> Variantene <i> возвращалась домой / шла (по дороге) домой</i> beskriver begge en prosess i imperfektivt aspekt, en prosess som danner bakgrunn for den videre historien. <br><br>
NORWEGIAN_COMMENT;

    private $russian_comment = <<< 'RUSSIAN_COMMENT'
Дословный перевод *<i>была по дороге домой</i> невозможен в силу лексической сочетаемости выражения по дороге с безличным оборотом <i>ей /ему было по дороге с ним /нею</i> в значении <i>в том же направлении, попутно</i>. <br><br> Варианты перевода <i>возвращалась домой / шла (по дороге) домой </i> оба сообщают о действии как о процессе в несовершенном виде, на фоне которого будут развиваться другие события. Оба переводчика применили конкретизирующие глаголы (способ конкретизации). Сравни: при переводе с английского языка слово <i>man</i> может быть переведено на русский язык многими конкретными лексическими единицами, в зависимости от того, о ком идет речь: человек, рядовой, мужчина. Противоположный способ – генерализация, т.е. вместо точного и не всегда понятного иноязычному читателю слова переводчик вправе его заменить на родовое наименование, например: сватья – родственница.
RUSSIAN_COMMENT;

    private $stripped_comment = <<< 'STRIPPED_COMMENT'
En ordrett oversettelse *<i>была по дороге домой</i> er uheldig her; <i>по дороге</i> kan eventuelt brukes i en upersonlig konstruksjon med kopulaverbet: <i>ей /ему было по дороге с ним /нею</i> med betydningen: <i>в том же направлении, попутно</i>. <br><br> Variantene <i> возвращалась домой / шла (по дороге) домой</i> beskriver begge en prosess i imperfektivt aspekt, en prosess som danner bakgrunn for den videre historien. <br><br>Дословный перевод *<i>была по дороге домой</i> невозможен в силу лексической сочетаемости выражения по дороге с безличным оборотом <i>ей /ему было по дороге с ним /нею</i> в значении <i>в том же направлении, попутно</i>. <br><br> Варианты перевода <i>возвращалась домой / шла (по дороге) домой </i> оба сообщают о действии как о процессе в несовершенном виде, на фоне которого будут развиваться другие события. Оба переводчика применили конкретизирующие глаголы (способ конкретизации). Сравни: при переводе с английского языка слово <i>man</i> может быть переведено на русский язык многими конкретными лексическими единицами, в зависимости от того, о ком идет речь: человек, рядовой, мужчина. Противоположный способ – генерализация, т.е. вместо точного и не всегда понятного иноязычному читателю слова переводчик вправе его заменить на родовое наименование, например: сватья – родственница.
STRIPPED_COMMENT;


    function test_should_extract_norwegian_part_from_the_comment()
    {
        $languageExtractor = new LanguageExtractor($this->realComment);
        $this->assertEquals(
            $this->norwegian_comment,
            $languageExtractor->extract_comment_in("norwegian"));

    }


   function test_should_extract_russian_part_from_the_comment()
    {

        $languageExtractor = new LanguageExtractor($this->realComment);
        $this->assertEquals(
            $this->russian_comment,
            $languageExtractor->extract_comment_in("russian"));

    }


    function test_when_empty_language_is_passed_return_the_stripped_comment()
    {
        $languageExtractor = new LanguageExtractor($this->realComment);
        $this->assertEquals(
            $this->stripped_comment,
            $languageExtractor->extract_comment_in(""));

    }

    function test_when_bogus_language_is_passed_return_the_stripped_comment()
    {
        $languageExtractor = new LanguageExtractor($this->realComment);
        $this->assertEquals(
            $this->stripped_comment,
            $languageExtractor->extract_comment_in("boguslanguage"));

    }


}
