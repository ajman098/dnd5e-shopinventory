function add_quickref_item(parent, data, type) {
    var icon = data.icon || "perspective-dice-six-faces-one";
    var subtitle = data.subtitle || "";
    var title = data.title || "[no title]";

    var item = document.createElement("div");
    item.className += "item itemsize"
    item.innerHTML =
    '\
    <div class="item-icon iconsize icon-' + icon + '"></div>\
    <div class="item-text-container text">\
        <div class="item-title">' + title + '</div>\
        <div class="item-desc">' + subtitle + '</div>\
    </div>\
    ';

    var style = window.getComputedStyle(parent.parentNode.parentNode);
    var color = style.backgroundColor;

    item.onclick = function () {
        show_modal(data, color, type);
    }

    parent.appendChild(item);
}

function show_modal(data, color, type) {
    var title = data.title || "[no title]";
    var subtitle = data.description || data.subtitle || "";
    var bullets = data.bullets || [];
    var reference = data.reference || "";
    type = type || "";
    color = color || "black"

    $("body").addClass("modal-open");
    $("#modal").addClass("modal-visible");
    $("#modal-backdrop").css("height", window.innerHeight + "px");
    $("#modal-container").css("background-color", color).css("border-color", color);
    $("#modal-title").text(title).append("<span class=\"float-right\">" + type + "</span>");
    $("#modal-subtitle").text(subtitle);
    $("#modal-reference").text(reference);

    var bullets_html = bullets.map(function (item) { return "<p class=\"fonstsize\">" + item + "</p>"; }).join("\n<hr>\n");
    $("#modal-bullets").html(bullets_html);
}

function hide_modal() {
    $("body").removeClass("modal-open");
    $("#modal").removeClass("modal-visible");
}

function fill_section(data, parentname, type) {
    var parent = document.getElementById(parentname);
    data.forEach(function (item) {
        add_quickref_item(parent, item, type);
    });
}

function init() {
    fill_section(data_weapons, "basic-weapons", "Weapons");
    fill_section(data_armor, "basic-armor", "Armor");
    fill_section(data_magic, "basic-magic", "Magic Items");
    fill_section(data_ammo, "basic-ammo", "Munitions");
	fill_section(data_gear, "basic-gear", "Adventuring Gear");
	fill_section(data_tools, "basic-tools", "Tool Kits");
	fill_section(data_clothing, "basic-clothing", "Clothing");
	fill_section(data_food, "basic-food", "Food & Drink");
	fill_section(data_stuff, "basic-stuff", "Commodities");
	fill_section(data_odds, "basic-odds", "Odds & Ends");
	fill_section(data_music, "basic-music", "Instruments");
	fill_section(data_pets, "basic-pets", "Pets");
	fill_section(data_mounts, "basic-mounts", "Mounts");
	fill_section(data_cars, "basic-cars", "Transport");
	fill_section(data_dudes, "basic-dudes", "Services");

    var modal = document.getElementById("modal");
    modal.onclick = hide_modal;
}

$(window).load(init);
