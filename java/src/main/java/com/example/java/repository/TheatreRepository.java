package com.example.java.repository;

import com.example.java.modules.Theatre;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
@RequiredArgsConstructor
public class TheatreRepository {
    private final JdbcTemplate jdbcTemplate;

    public List<Theatre> selectAll() {
        String SQL = "SELECT * FROM theatres";
        return jdbcTemplate.query(SQL, new BeanPropertyRowMapper<>(Theatre.class));
    }

    public boolean insert(Theatre theatre) {
        String SQL = "INSERT INTO theatres (img_src, url_theatre, name_theatre) VALUES (?, ?, ?)";
        return jdbcTemplate.update(
                SQL,
                theatre.getImgSrc(),
                theatre.getUrlTheatre(),
                theatre.getNameTheatre()
        ) > 0;
    }

    public boolean update(Theatre theatre) {
        String SQL = "UPDATE theatres SET img_src=?, url_theatre=?, name_theatre=? WHERE ID=?";
        return jdbcTemplate.update(
                SQL,
                theatre.getImgSrc(),
                theatre.getUrlTheatre(),
                theatre.getNameTheatre()
        ) > 0;
    }

    public boolean delete(Integer id) {
        String SQL = "DELETE FROM `theatres` WHERE `ID`=?";
        return jdbcTemplate.update(SQL, id) > 0;
    }
}
