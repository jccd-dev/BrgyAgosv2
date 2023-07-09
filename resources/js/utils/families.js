import $, { event, isEmptyObject } from 'jquery'
import axios from 'axios'


class SearchInputs{
    constructor(parentEl) {
        this.parentEl = parentEl,
        this.searchInput = this.parentEl.find('#searchInput'),
        this.optionContainer = this.parentEl.find('#optionsContainer'),
        this.dropDownToggle = this.parentEl.find('.dropdown-toggle'),
        this.menu = this.parentEl.find('.dropdown-menu')
    }

    search(term){
        axios.get('/dashboard/get-option', {
            params: {search : term}
        }).then((response) => {
            this.optionContainer.empty()

            if (!isEmptyObject(response.data)) {
                response.data.forEach((option) => {
                  let optionEl = $('<a class="dropdown-item" href="#" data-id="' + option.id + '">' + `${option.fname} ${option.lname}` + '</a>');
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
            // console.log(response.data)
        }).catch(error => {
            console.log(error)
        })
    }

    onInput(){
        this.searchInput.on('input', ()=>{
            const searchTerm = this.searchInput.val()
            if(searchTerm == null){
                this.optionContainer.hide()
            }
            // console.log(searchTerm)
            this.search(searchTerm)
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
    }

}

export default SearchInputs
