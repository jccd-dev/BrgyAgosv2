import $, { event, isEmptyObject } from 'jquery'
import axios from 'axios'


class SearchInputs{
    constructor(parentEl) {
        this.parentEl = parentEl
        this.searchInput = this.parentEl.find('#searchInput');
        if (this.searchInput.length == 0) {
            this.searchInput = this.parentEl.find('#fam_head');
        }
        this.optionContainer = this.parentEl.find('#optionsContainer')
        this.dropDownToggle = this.parentEl.find('.dropdown-toggle')
        this.menu = this.parentEl.find('.dropdown-menu')
    }

    search(data, search_type){
        this.optionContainer.empty()

        if (!isEmptyObject(data)) {
            data.forEach((option) => {
                let optionEl
                if(search_type == 'families'){
                    optionEl = $('<a class="dropdown-item" href="#" data-id="' + option.id + '">' + `${option.fname} ${option.lname}` + '</a>');
                }
                else if(search_type == 'household'){
                    optionEl = $('<a class="dropdown-item" href="#" data-id="' + option.id + '">' + `${option.family_name}` + '</a>');
                }
                else{
                    let resident = option.resident
                    optionEl = $('<a class="dropdown-item" href="#" data-id="' + resident.id + '">' + `${resident.fname} ${resident.lname}` + '</a>');
                }
                let self = this; // Store reference to 'this'
                optionEl.on('click', function() {
                    let selectedName = $(this).text();
                    self.searchInput.val(selectedName); // Use 'self' instead of 'this'
                    let selected_id = $(this).data('id');
                    self.searchInput.data('id', selected_id)
                    self.searchInput.removeClass('border-danger')
                    self.optionContainer.fadeOut(400);
                });
                this.optionContainer.append(optionEl);
            });
            this.optionContainer.show();
        } else {
            this.optionContainer.fadeOut(300);
            this.optionContainer.empty()
        }
    }

    populateOptions(endPoint, searchTerm, search_type){
        axios.get(endPoint, {params: { search : searchTerm}})
            .then((response) => {
                this.search(response.data, search_type)
            })
            .catch(err=>{
                console.log(err)
            })
    }

    onInput(search_type, endPoint){
        this.searchInput.on('input', ()=>{
            const searchTerm = this.searchInput.val()
            if(searchTerm == null){
                this.optionContainer.hide()
            }
            this.populateOptions(endPoint, searchTerm, search_type)
        })
    }

    showOptions(){
        this.dropDownToggle.on('click', ()=>{
            this.optionContainer.toggle()
        })
    }

    hideOptions(){
        this.dropDownToggle.on('click', (event) => {
            const target = $(event.target)
            if(!target.hasClass('dropdown-toggle') && !target.hasClass('dropdown-item')){
                this.menu.hide()
            }
        })

        $(document).on('click', (event) => {
            const target = $(event.target)
            if(!target.hasClass('dropdown-toggle') && !target.hasClass('dropdown-item')){
                this.menu.hide()
            }
        })
    }

}

export default SearchInputs
