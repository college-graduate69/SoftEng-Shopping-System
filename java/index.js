/*slideshow script*/
var index=1;
function plusIndex(n)
{
    index=index+1;
    showImage(index);
}
function showImage(n)
{
    var x=document.getElementsByClassName("slideimgs");
    if(n>x.length)
    {
        index=1;
    }
    if(n<1)
    {
        index=x.length;
    }
    for(var i=0;i<x.length;i++)
    {
        x[i].style.display="none";
    }
    x[index-1].style.display="block";
}
function autoSlide()
{
    var x=document.getElementsByClassName("slideimgs");
    for(var i=0;i<x.length;i++)
    {
        x[i].style.display="none";
    }
    if(index>x.length)
    {
        index=1;
    }
    x[index-1].style.display="block";
    index++;
    setTimeout(autoSlide, 2300);
}
showImage();
autoSlide();