function convertColor(text, colorCode)
{
	while (text.indexOf('[' + colorCode + ']') != -1 && text.indexOf('[/' + colorCode + ']') != -1 && text.indexOf('[/' + colorCode + ']') > text.indexOf('[' + colorCode + ']'))
	{
		text = text.replace('[' + colorCode + ']', '<span style="color:' + colorCode + '">');
		text = text.replace('[/' + colorCode + ']', '</span>');
	}
	return text;
}