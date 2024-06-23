const priceRange = document.getElementById('price-range');
const priceValue = document.getElementById('price-value');

priceRange.addEventListener('input', function()
{
    priceValue.textContent = priceRange.value + '$';
});

function toggleDropdown()
{
    let dropdownContent = document.getElementById("dropdown-content");
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
    let dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++)
    {
        let dropdown = dropdowns[i];
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

function checkFunction() {
    // Get all checkboxes
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');

    // Iterate through all checkboxes
    checkboxes.forEach(function(checkbox) {
        let label = document.querySelector(`label[for="${checkbox.id}"]`);
        if (checkbox.checked) {
            label.classList.add('checked');
            label.classList.remove('unchecked');
        } else {
            label.classList.add('unchecked');
            label.classList.remove('checked');
        }
    });
}

function checkColorFunction(color) {
    let checkbox = document.getElementById(color);
    checkbox.checked = !checkbox.checked;

    let colorDiv = document.getElementById(`${color}-div`);
    if (checkbox.checked) {
        colorDiv.classList.add('checked-color');
        colorDiv.classList.remove('unchecked');
    } else {
        colorDiv.classList.add('unchecked');
        colorDiv.classList.remove('checked-color');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Funcție pentru afișarea/ascunderea filtrelor
    function toggleFilter(filterClass) {
        var filters = document.querySelector('.' + filterClass);
        filters.classList.toggle('show');
    }

    // Event listeners pentru butoanele de toggle
    document.getElementById('toggle-category').addEventListener('click', function() {
        toggleFilter('categories');
    });

    document.getElementById('toggle-brand').addEventListener('click', function() {
        toggleFilter('brands');
    });

    document.getElementById('toggle-color').addEventListener('click', function() {
        toggleFilter('colors-container');
    });

    document.getElementById('toggle-size').addEventListener('click', function() {
        toggleFilter('sizes');
    });

    document.getElementById('toggle-price').addEventListener('click', function() {
        toggleFilter('prices');
    });

    // Funcția pentru a actualiza eticheta de preț în funcție de valoarea slider-ului
    var priceRange = document.getElementById('price-range');
    var priceValue = document.getElementById('price-value');

    priceRange.addEventListener('input', function() {
        priceValue.textContent = this.value + '$';
    });

    // Funcția pentru a gestiona starea checkbox-urilor și Local Storage (așa cum am implementat anterior)
    function updateCheckedState(elements) {
        elements.forEach(function(element) {
            var divId = element.id + '-div';
            var div = document.getElementById(divId);

            var localStorageKey = 'checkbox_' + element.id;
            var isChecked = localStorage.getItem(localStorageKey);

            if (isChecked === 'true') {
                element.checked = true;
                div.classList.add('checked-color');
            } else {
                element.checked = false;
                div.classList.remove('checked-color');
            }

            element.addEventListener('change', function() {
                if (element.checked) {
                    div.classList.add('checked-color');
                } else {
                    div.classList.remove('checked-color');
                }
                localStorage.setItem(localStorageKey, element.checked);
            });
        });
    }

    var categories = document.querySelectorAll('.categories input[type="checkbox"]');
    var brands = document.querySelectorAll('.brands input[type="checkbox"]');
    var colors = document.querySelectorAll('.color input[type="checkbox"]');
    var sizes = document.querySelectorAll('.sizes input[type="checkbox"]');

    updateCheckedState(categories);
    updateCheckedState(brands);
    updateCheckedState(colors);
    updateCheckedState(sizes);
});
