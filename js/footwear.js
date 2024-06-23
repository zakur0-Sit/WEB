const priceRange = document.getElementById('price-range');
const priceValue = document.getElementById('price-value');

priceRange.addEventListener('input', function()
{
    priceValue.textContent = priceRange.value + '$';
});

function toggleDropdown()
{
    var dropdownContent = document.getElementById("dropdown-content");
    if (dropdownContent.style.display === "block")
    {
        dropdownContent.style.display = "none";
    }
    else
    {
        dropdownContent.style.display = "block";
    }
}

window.addEventListener("resize", function()
{
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++)
    {
        var dropdown = dropdowns[i];
        if (window.innerWidth >= 951)
        {
            dropdown.style.display = "block";
        }
        else
        {
            dropdown.style.display = "none";
        }
    }
});

// function checkFunction