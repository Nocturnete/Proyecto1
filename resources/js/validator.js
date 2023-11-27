import Validator from 'validatorjs';


// Multilanguage customization


import ca from 'validatorjs/src/lang/ca';
import es from 'validatorjs/src/lang/es';
import en from 'validatorjs/src/lang/en';
import fr from 'validatorjs/src/lang/fr';


Validator.setMessages('ca', ca)
Validator.setMessages('es', es)
Validator.setMessages('en', en)
Validator.setMessages('fr', fr)

const locale = (typeof currentLocale === 'undefined') ? 'en' : currentLocale
Validator.useLang(locale)


export default Validator