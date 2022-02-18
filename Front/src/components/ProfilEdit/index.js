import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';
import ProfilForm from 'src/components/ProfilEdit/ProfilForm';
import Login from 'src/components/Login';

import { useSelector } from 'react-redux';
import { useParams } from 'react-router-dom';

import './style.scss';

const ProfilEdit = () => {
  const loginMenu = useSelector((state) => state.loginIsClicked);
  const profiles = useSelector((state) => state.profiles);

  const parameters = useParams();
  const currentSlug = parameters.slug;

  // We use the "==" Because the slug is a string and the id is an int
  // We check for the profile which have the id which correspond to the slug
  // eslint-disable-next-line eqeqeq
  const profile = profiles.find((testedProfile) => testedProfile.id == currentSlug);

  return (
    <div className="content profilesEditContent">
      <AppHeader />
      <div className="invisible-div" />
      <main className="main profilEditMain">
        {loginMenu && <Login />}
        <ProfilForm {...profile} />
      </main>
      <Footer />
    </div>
  );
};

export default ProfilEdit;
