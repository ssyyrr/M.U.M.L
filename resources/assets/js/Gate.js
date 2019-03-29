export default class Gate{
    constructor(user){

        this.user = user;

    }
    isSuperadministrator(){

        return this.user.type === 'Superadministrator';

    }
    isAdministrator(){

        return this.user.type === 'Administrator';

    }
    isEnseignant(){

        return this.user.type === 'Enseignant';

    }
    isUser(){

        return this.user.type === 'Etudiant';

    }
    isSuperadministratorOrAdministratorOrEnseignant(){

        if(this.user.type === 'Superadministrator' || this.user.type === 'Administrator'|| this.user.type === 'Enseignant'){

            return true;

        }
    }
    isSuperadministratorOrAdministrator(){

        if(this.user.type === 'Superadministrator' || this.user.type === 'Administrator'){

            return true;

        }
    }
    isAdministratorOrEnseignant(){

        if(this.user.type === 'Administrator' || this.user.type === 'Enseignant'){

            return true;

        }
    }
    isUserOrEnseignant(){

        if(this.user.type === 'Etudiant' || this.user.type === 'Enseignant'){

            return true;

        }
    }


}
