let opacity = 0;
let interval_Id = 0;

function fade_in()
{
    interval_Id = setInterval(show, 200);
}

function show()
{
    const task = document.getElementById("task");
    opacity = Number(window.getComputedStyle(task).getPropertyValue("opacity"));
    if(opacity < 1)
    {
        opacity = opacity + 0.1;
        task.style.opacity = opacity;
    }
    else
    {
        clearInterval(interval_Id);
    }
}

function fade_out()
{
    interval_Id = setInterval(hide, 200);
}

function hide()
{
    const task = document.getElementById("task");
    opacity = Number(window.getComputedStyle(task).getPropertyValue("opacity"));
    if(opacity > 0)
    {
        opacity = opacity-0.1;
        task.style.opacity = opacity;
    }
    else
    {
        clearInterval(interval_Id);
    }
}
