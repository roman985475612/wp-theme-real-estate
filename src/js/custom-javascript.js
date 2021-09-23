class Form {
    constructor( form, submitBtn ) {
        this.form = form
        this.submitBtn = submitBtn
    
        this.form.addEventListener( 'focusin', this.clearForm )

        this.submitBtn.addEventListener( 'click', async e => {
            this.submitForm()
        } )
        
        this.form.addEventListener( 'submit', async e => {
            e.preventDefault()
            this.submitForm()
        } )    
    }

    clearForm(e) {
        if (e.target.classList.contains('validated-field')) {
            e.target.classList.remove('is-invalid')
            e.target.classList.remove('is-valid')
        }
    }
    
    validation() {
        let patterns = {
            notEmpty: /.+/,
            email: /^.+@.+\..+$/,
            phone: /^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/
        }
    
        let fields = this.form.querySelectorAll('.validated-field')
        let isValid = true
        
        fields.forEach(f => {
            let pattern = patterns[f.dataset.valid]
            f.value = f.value.trim()
            
            if (pattern.test(f.value)) {
                f.classList.add('is-valid')
            } else {
                f.classList.add('is-invalid')
                isValid = false
            }
        })
        return isValid
    }

    async submitForm() {
        this.submitBtn.disabled = true

        if( this.validation() ) {
            const formData = new FormData( this.form )
            formData.append( 'nonce', window.rmnVars.nonce )
    
            const response = await fetch(window.rmnVars.ajaxurl, {
                method: 'POST',
                body: formData
            })

            if( ! response.ok ) {
                throw 'Ошибка запроса!';
            }

            let result = await response.json()

            if ( result.is_valid ) {
                document.querySelector( '.modal-backdrop' ).style.display = 'none'
                document.querySelector( '#newRealEstate' ).style.display = 'none'

                this.form.reset()

                alert( result['msg'] )
            } else {
                throw result['errors']
            }    
        }
        
        this.submitBtn.disabled = false
    }
}

try {
    const $form = document.querySelector( '#newRealEstateForm' );
    const $submitBtn = document.querySelector( '.form-submit' )
    const form = new Form( $form, $submitBtn );    
} catch ( e ) {
    alert( e.message )
}
