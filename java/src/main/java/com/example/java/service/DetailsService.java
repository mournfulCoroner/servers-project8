package com.example.java.service;

import com.example.java.modules.User;
import com.example.java.repository.UserRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.security.core.authority.AuthorityUtils;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class DetailsService implements UserDetailsService {
    private final UserRepository userRepository;

    /**
     * Нужен для настройки поиска пользователя по имени в SpringSecurity
     * @param username имя пользователя
     * @return экземпляр класса org.springframework.security.core.userdetails.User
     * @throws UsernameNotFoundException если пользователь не найден, то выкидывает эту ошибку
     */
    @Override
    public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
        User user = userRepository.findByName(username);
        if (user == null){
            return null;
        }
        return new org.springframework.security.core.userdetails.User(
                user.getName(),
                user.getPassword(),
                AuthorityUtils.createAuthorityList(new String[] {"ROLE_USER"})
        );
    }
}
